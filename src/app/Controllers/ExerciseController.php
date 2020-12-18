<?php

require_once dirname(__DIR__,1).'/Models/Exercise.php';
require_once dirname(__DIR__,1).'/Models/QuestionField.php';
require_once dirname(__DIR__,1).'/Models/Fulfillment.php';
require_once dirname(__DIR__,1).'/Models/Take.php';
require_once dirname(__DIR__,1).'/Models/Answer.php';


class ExerciseController {

    /**
     * This method gets all the exercises and displays it on the manage view
     */
    public function manage() {

        $exerciseModel = new Exercise();
        $exercises = $exerciseModel->all();

        require_once "../ressources/views/exercises/manage.php";
    }

    /**
     * This method displays the view to create an exercise
     */
    public function create() {
        require_once "../ressources/views/exercises/create.php";
    }

    /**
     * This method gets all the exercises and displays it on the take view
     */
    public function listAnswering() {
        $exerciseModel = new Exercise();
        $exercises = array_filter($exerciseModel->all(), function($e) {
            return $e["state"] == "Answering";
        });

        require_once "../ressources/views/exercises/listAnswering.php";
    }

    public function takeNew($exerciseId) {
        $ex = (new Exercise())->find($exerciseId);
        if(!isset($ex[0]) || !isset($ex[0]["id"]) || $ex[0]["state"] != "Answering") {
            require_once "../ressources/views/404.php";
        }

        $questionFieldModel = new QuestionField();
        $questions = $questionFieldModel->findByExerciseId($exerciseId);

        $data = [
            "exerciseId" => $exerciseId,
            "questionfields" => $questions
        ];

        require_once "../ressources/views/exercises/take.php";
    }

    public function takeEdit($exerciseId, $takeId) {
        $ex = (new Exercise())->find($exerciseId);
        if(!isset($ex[0]) || !isset($ex[0]["id"]) || $ex[0]["state"] != "Answering") {
            require_once "../ressources/views/404.php";
        }

        $take = (new Take())->find($takeId);
        if(!isset($take[0]) || !isset($take[0]["id"])) {
            require_once "../ressources/views/404.php";
        }

        $fulfillmentModel = new Fulfillment();
        $fulfillments = $fulfillmentModel->findByTakeId($takeId);

        $data = [
            "exerciseId" => $exerciseId,
            "takeId" => $takeId,
            "questionfields" => $fulfillments
        ];

        require_once "../ressources/views/exercises/take.php";
    }

    /**
     * This method stores the created exercise
     */
    public function store() {

        $exerciseModel = new Exercise();

        $data = ['title' => $_POST['title'], 'state' => 'Building'];

        $lastId = $exerciseModel->insert($data);

        if($lastId) {
            header("Location: /exercises/".$lastId."/questions-fields");
        }
        else {
            header("Location: /exercises/");
        }
    }

    public function delete($id) {
        $ex = new Exercise();
        $ex->delete($id);

        $this->manage();
    }

    public function setState($id, $state) {
        $ex = new Exercise();
        $ex->update($id, [ $state ], [ 'state' ]);

        $this->manage();
    }

    public function exerciseResults($exerciseId) {
        $questionFieldModel = new QuestionField();
        $questions = $questionFieldModel->findByExerciseId($exerciseId);

        $fulFillmentModel = new Fulfillment();
        $fulFillments = $fulFillmentModel->findByExerciseId($exerciseId);

        $takes = [];

        foreach($fulFillments as $fId => $fData) {
            if(!array_key_exists($fData["takesId"], $takes)) {
                $takes[$fData["takesId"]] = [
                    "title" => $fData["title"],
                    "questionsTakes" => []
                ];
            }
            $fillPower = 0;
            $inputLength = strlen($fData["answer"]);

            if($inputLength > 0) $fillPower = 1;
            if ($inputLength > 75) $fillPower = 2;

            $takes[$fData["takesId"]]["questionsTakes"][$fData["id"]] = $fillPower;
        }

        $data = [
            "exerciseId" => $exerciseId,
            "questions" => $questions,
            "takes" => $takes
        ];
        require_once "../ressources/views/exercises/exerciseResults.php";
    }

    public function takeDisplay($exerciseId, $takeId) {
        $ex = (new Exercise())->find($exerciseId)[0];
        $fu = (new Fulfillment())->findByTakeId($takeId);
        $data = [
            "exerciseId" => $exerciseId,
            "exerciseTitle" => $ex["title"],
            "takeId" => $takeId,
            "takeTitle" => $fu[0]["title"],
            "questionsAnswers" => $fu
        ];

        require_once "../ressources/views/exercises/takeDisplay.php";
    } 

    public function questionResults($exerciseId, $questionId) {
        $ex = (new Exercise())->find($exerciseId)[0];
        $qu = (new QuestionField())->find($questionId)[0];
        $fu = (new Fulfillment())->findByExerciseIdAndQuestionId($exerciseId, $questionId);

        $data = [
            "exerciseId" => $exerciseId,
            "exerciseTitle" => $ex["title"],
            "questionId" => $questionId,
            "questionTitle" => $qu["label"],
            "takes" => $fu
        ];

        require_once "../ressources/views/exercises/questionResults.php";
    }

    // This shouldn't be in this controller, but who cares. I sure don't
    public function storeTakeAnswersData($exId) {
        $take = new Take();
        $takeId = $take->insert(['title' => date('c', time())]);

        foreach($_POST["answers"] as $answerId => $answerData) {
            $answer = new Answer();
            $answerId = $answer->insert([
               'answer' => $answerData,
               'questionsFieldsId' => $answerId
            ]);

            $fulfillment = new Fulfillment();
            $fulfillment->insert([
                'answersId' => $answerId,
                'exercisesId' => $exId,
                'takesId' => $takeId
            ]);
        }

        header("Location: /exercises/".$exId."/take/".$takeId."/edit");
    }

    public function updateTakeAnswersData($exId, $takeId) {
        foreach($_POST["answers"] as $answerId => $answerData) {
            $answer = new Answer();
            $answer->update($answerId, [$answerData], ['answer']);
        }

        header("Location: /exercises/".$exId."/take/".$takeId."/edit");
    }
}