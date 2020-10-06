<?php

use PHPUnit\Framework\TestCase;
require_once "../../app/Router.php";

class RouterTest extends TestCase {
    public function test_simpleGET() {
        $router = new \Looper\App\Router();
        $router->add("/", function(){ $this->assertTrue(true); }, "GET");
        $router->run("/", "GET");
    }

    public function test_correctMethod() {
        $router = new \Looper\App\Router();
        $router->add("/", function() { $this->assertTrue(false); }, "GET");
        $router->add("/", function() { $this->assertTrue(true); }, "POST");

        $router->run("/", "POST");
    }

    public function test_prioritizeMostSpecifiedRoute() {
        $router = new \Looper\App\Router();
        $router->add("/:testArg", function() { $this->assertTrue(false); }, "GET");
        $router->add("/test", function() { $this->assertTrue(true); }, "GET");

        $router->run("/test", "GET");
    }

    public function test_parseRouteArguments() {
        $router = new \Looper\App\Router();
        $router->add("/:arg1/:arg2", function($arg1, $arg2) {
            $this->assertEquals("test1", $arg1);
            $this->assertEquals(1234, $arg2);
        }, "GET");

        $router->run("/test1/1234/", "GET");
    }

    public function test_throwsWithUnknownRoute() {
        $router = new \Looper\App\Router();
        $this->expectException(\UnexpectedValueException::class);

        $router->run("/", "GET");
    }

    public function test_callsControllerAction() {
        $router = new \Looper\App\Router();
        $router->add("/", "DummyController::DummyAction", "GET");

        $router->run("/", "GET");
    }

    public function test_throwsWithUnknownController() {
        $router = new \Looper\App\Router();
        $router->add("/", "foo::bar", "GET");
        $this->expectException(\InvalidArgumentException::class);

        $router->run("/", "GET");
    }

    public function test_throwsWithUnknownAction() {
        $router = new \Looper\App\Router();
        $router->add("/", "DummyController::bar", "GET");
        $this->expectException(\InvalidArgumentException::class);

        $router->run("/", "GET");
    }

    public function test_throwsWithEmptyAction() {
        $router = new \Looper\App\Router();
        $router->add("/", "DummyController::", "GET");
        $this->expectException(\InvalidArgumentException::class);

        $router->run("/", "GET");
    }

    public function test_throwsWithMalformedActionString() {
        $router = new \Looper\App\Router();
        $router->add("/", "foo:bar", "GET");
        $this->expectException(\InvalidArgumentException::class);

        $router->run("/", "GET");
    }
}