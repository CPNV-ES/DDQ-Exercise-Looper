<?php
require_once "../app/Router.php";

$webrouter = new \Looper\App\Router();

$webrouter->add("/", "HomeController::index");
$webrouter->add("/exercises", "ExerciseController::index");
$webrouter->add("/exercises/new", "ExerciseController::create");
$webrouter->add("/exercises/new", "ExerciseController::store", "POST");
$webrouter->add("/exercises/take", "ExerciseController::take");
$webrouter->add("/exercises/:id/questions-fields", "QuestionsController::index");

try {
    $webrouter->run();
}
catch(InvalidArgumentException $ex) {
    // TODO: handle these exceptions better
    echo "Invalid route: " . $ex;
}
catch(UnexpectedValueException $ex) {
    // TODO: handle these exceptions better
    echo "No route found: " . $ex;
}