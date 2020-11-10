<?php
require_once "../app/Router.php";

$webrouter = new \Looper\App\Router();

$webrouter->add("/", "HomeController::index");
$webrouter->add("/exercises", "ExerciseController::manage");
$webrouter->add("/exercises/new", "ExerciseController::create");
$webrouter->add("/exercises/new", "ExerciseController::store", "POST");
$webrouter->add("/exercises/answering", "ExerciseController::listAnswering");
$webrouter->add("/exercises/:exerciseId/take/new", "ExerciseController::takeNew");
$webrouter->add("/exercises/:exerciseId/take/:takeId/edit", "ExerciseController::takeEdit");
$webrouter->add("/exercises/:exerciseId/take/:takeId", "ExerciseController::takeDisplay");
$webrouter->add("/exercises/:exerciseId/results", "ExerciseController::exerciseResults");
$webrouter->add("/exercises/:exerciseId/results/:questionId", "ExerciseController::questionResults");
$webrouter->add("/exercises/listAnswering", "ExerciseController::listAnswering");
$webrouter->add("/exercises/:id/questions-fields", "QuestionsController::index");

try {
    $webrouter->run();
}
catch(InvalidArgumentException | UnexpectedValueException $ex) {
    require_once "../ressources/views/404.php";
}