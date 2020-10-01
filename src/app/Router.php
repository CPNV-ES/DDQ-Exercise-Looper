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
        $requestUri = rtrim($requestUri, "/");

        foreach($this->routes as $route) {
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $args = [];
            if(in_array($method, $route["methods"]) && preg_match($pattern, $requestUri, $args)) {
                array_shift($args);  // remove first match as it contains the whole request uri

                $actionType = gettype($route["action"]);

                if($actionType == "string" && strpos($route["action"], "::") != -1 ) {
                    $parts = explode("::", $route["action"]);
                    $controllerName = $parts[0];
                    $actionName = $parts[1];
                    $classPath = "../app/Controllers/" . $controllerName . ".php";

                    if(!file_exists($classPath)) {
                        $this->error_404();
                        return;
                    }

                    include $classPath;
                    $controller = new $controllerName;

                    if(!method_exists($controller, $actionName)) {
                        $this->error_404();
                        return;
                    }

                    call_user_func_array([$controller, $actionName], $args);
                }
                elseif($actionType == "object" && is_callable($route["action"])) {
                    call_user_func_array($route["action"], $args);
                }

                return;
            }
        }

        $this->error_404();
    }

    public function add($url, $action, $methods = "GET") {
        if(gettype($methods) == "string")
            $methods = [$methods];

        $url = rtrim($url, "/");

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

    public function error_404() {
        echo "404 lole";
    }
}