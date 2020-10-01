<?php
require_once "../app/Router.php";

$webrouter = new \Looper\App\Router();
    
$webrouter->add("/exercises", "ExerciseController::index");
$webrouter->run();