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
<<<<<<< HEAD
$webrouter->add("/exercises/:id/delete", "ExerciseController::delete");
$webrouter->add("/exercises/:exerciseId/setState/:stateId", "ExerciseController::setState");
$webrouter->add("/exercises/:id/questions-fields", "QuestionsController::index");
$webrouter->add("/exercises/storeTakeAnswersData/:exerciseId", "ExerciseController::storeTakeAnswersData", "POST");
$webrouter->add("/exercises/updateTakeAnswersData/:exerciseId/:takeId", "ExerciseController::updateTakeAnswersData", "POST");
=======
$webrouter->add("/exercises/:id/questions-fields", "QuestionController::index");
$webrouter->add("/exercises/:id/questions-fields", "QuestionController::store","POST");
$webrouter->add("/exercises/:id/questions-fields/:fieldsId/edit", "QuestionController::edit");
$webrouter->add("/exercises/:id/questions-fields/:fieldsId", "QuestionController::update",'POST');
$webrouter->add("/exercises/:id/questions-fields/:fieldsId/delete", "QuestionController::delete");

>>>>>>> questions-fields

try {
    $webrouter->run();
}
catch(InvalidArgumentException | UnexpectedValueException $ex) {
    require_once "../ressources/views/404.php";
}