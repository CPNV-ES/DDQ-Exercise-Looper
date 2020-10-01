<?php
require_once "../app/Router.php";

$webrouter = new \Looper\App\Router();
    
$webrouter->add("/exercises", "ExerciseController::index");
$webrouter->add("/exercises/new", "ExerciseController::new");
$webrouter->add("/exercises/take", "ExerciseController::take");

$webrouter->run();