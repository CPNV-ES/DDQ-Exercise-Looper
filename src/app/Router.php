<?php
namespace Looper\App;

class Router {
    private $routes;

    public function __construct() {
        $this->routes = [];
    }

    public function run($requestUri = null, $requestMethod = null) {
        $method = isset($requestMethod) ? $requestMethod : $_SERVER["REQUEST_METHOD"];
        $requestUri = isset($requestUri) ? $requestUri : $_SERVER["REQUEST_URI"];
        $queryParts = parse_url($requestUri);
        parse_str($queryParts["query"] ?? "", $_GET);
        $requestUri = rtrim(rtrim($queryParts["path"], "?"), "/"); // remove the query string and trailing question mark and slashes

        foreach($this->routes as $route) {
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $args = [];
            if(in_array($method, $route["methods"]) && preg_match($pattern, $requestUri, $args)) {
                array_shift($args);  // remove first match as it contains the whole request uri

                $actionType = gettype($route["action"]);

                if($actionType == "string") {   // Action is controller's action
                    if(strpos($route["action"], "::") == false) {
                        throw new \InvalidArgumentException("The action string is malformed");
                    }

                    $parts = explode("::", $route["action"]);
                    $controllerName = $parts[0];
                    $actionName = $parts[1];
                    $classPath = "../app/Controllers/" . $controllerName . ".php";

                    if(!file_exists($classPath)) {
                        throw new \InvalidArgumentException("The specified controller does not exist: " . $controllerName);
                    }

                    include_once $classPath;
                    $controller = new $controllerName;

                    if(!method_exists($controller, $actionName)) {
                        throw new \InvalidArgumentException("The specified action method '" .$actionName . "' does not exist in the controller class '" . $controllerName . "'");
                    }

                    call_user_func_array([$controller, $actionName], $args);
                }
                elseif($actionType == "object" && is_callable($route["action"])) {  // Action is anonymous function
                    call_user_func_array($route["action"], $args);
                }
                else {  // Invalid action type
                    throw new \UnexpectedValueException("No matching routes were found for request uri: " . $requestUri);
                }

                return;
            }
        }

        throw new \UnexpectedValueException("No matching routes were found for request uri: " . $requestUri);
    }

    public function add($url, $action, $methods = "GET") {
        if(gettype($methods) == "string")
            $methods = [$methods];

        $url = rtrim($url, "/");

        foreach($this->routes as $route) {
            if($route["url"] != $url) continue;
            if(array_intersect($route["methods"], $methods)) {
                throw new \InvalidArgumentException("A route with the same URL and at least one of the same method is already registered.");
            }
        }

        array_push($this->routes, [
            "url" => $url,
            "action" => $action,
            "methods" => $methods,
        ]);

        // Sort routes based on their url to give routes with no parameter higher priority
        usort($this->routes, function($a, $b) {
            return substr_count($a["url"], "/") - substr_count($a["url"], ":") < substr_count($b["url"], "/")  - substr_count($b["url"], ":");
        });
    }
}