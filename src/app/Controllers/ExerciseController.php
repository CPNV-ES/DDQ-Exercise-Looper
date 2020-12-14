<?php

require_once dirname(__DIR__,1).'/Models/Exercise.php';
require_once dirname(__DIR__,1).'/Models/QuestionField.php';
require_once dirname(__DIR__,1).'/Models/Fulfillment.php';
require_once dirname(__DIR__,1).'/Models/Take.php';

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
        $exercises = $exerciseModel->all();

        require_once "../ressources/views/exercises/listAnswering.php";
    }

    public function takeNew($exerciseId) {
        $questionFieldModel = new QuestionField();

        $questions = $questionFieldModel->findByExercise($exerciseId);

        $data = [
            "exerciseId" => $exerciseId,
            "questionfields" => $questions
        ];

        require_once "../ressources/views/exercises/take.php";
    }

    public function takeEdit($exerciseId, $takeId) {
        $data = [
            "exerciseId" => $exerciseId,
            "takeId" => $takeId,
            // TODO : THIS IS TEST DATA, GET DATA FROM MODEL (AND MAYBE DIRECTLY PASS MODEL RATHER THAN A DICTIONARY)!
            "questionfields" => [
                [
                    "id" => 1,
                    "label" => "Test1",
                    "valueType" => "Single line text",
                    "value" => "Some value"
                ],
                [
                    "id" => 2,
                    "label" => "Test2",
                    "valueType" => "List of single lines",
                    "value" => "Some\nMultiline\nValue"
                ],
                [
                    "id" => 3,
                    "label" => "Test3",
                    "valueType" => "List of Multi-line text",
                    "value" => "Some\nMultiline\nValue"
                ]
            ]
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

    public function exerciseResults($exerciseId) {
        $questionFieldModel = new QuestionField();
        $questions = $questionFieldModel->findByExercise($exerciseId);

        $fulFillmentModel = new Fulfillment();
        $fullFillments = $fulFillmentModel->findByExercise($exerciseId);

        $data = [
            "exerciseId" => $exerciseId,
            // TODO : THIS IS TEST DATA, GET DATA FROM MODEL (AND MAYBE DIRECTLY PASS MODEL RATHER THAN A DICTIONARY)!
            "questions" => $questions,
            "takes" => [
                500 => [
                    "title" => "2020-08-25 09:01:22 UTC",
                    "questionsTakes" => [
                        100 => 0,
                        102 => 2,
                        101 => 1,
                    ]
                ],
                508 => [
                    "title" => "2020-08-25 09:03:56 UTC",
                    "questionsTakes" => [
                        100 => 0,
                        103 => 2,
                        102 => 1
                    ]
                ],
                504 => [
                    "title" => "2020-08-25 09:02:12 UTC",
                    "questionsTakes" => [
                        102 => 2,
                        101 => 1,
                        100 => 0
                    ]
                ],
                505 => [
                    "title" => "2020-08-25 09:03:43 UTC",
                    "questionsTakes" => [
                        100 => 0,
                        101 => 1,
                        102 => 2
                    ]
                ],
            ]
        ];
        require_once "../ressources/views/exercises/exerciseResults.php";
    }

    public function takeDisplay($exerciseId, $takeId) {
        $data = [
            "exerciseId" => $exerciseId,
            "exerciseTitle" => "Le test de votre vie",
            "takeId" => $takeId,
            "takeTitle" => "2020-01-01 2020-08-25 09:03:43 UTC",
            // TODO : THIS IS TEST DATA, GET DATA FROM MODEL (AND MAYBE DIRECTLY PASS MODEL RATHER THAN A DICTIONARY)!
            "questionsAnswers" => [
                [
                    "id" => 101,
                    "question" => "A. Lorem ipsum dolor sit amet?",
                    "answer" => "Oui"
                ],
                [
                    "id" => 103,
                    "question" => "C. Ut enim ad minim veniam, aute irure dolor ?",
                    "answer" => "Lorem ipsum dolor sit amet\nSunt in culpa qui officia",
                ],
                [
                    "id" => 102,
                    "question" => "B. Sunt in culpa qui officia?",
                    "answer" => "Non.",
                ]
            ]
        ];

        require_once "../ressources/views/exercises/takeDisplay.php";
    } 

    public function questionResults($exerciseId, $questionId) {
        $data = [
            "exerciseId" => $exerciseId,
            "exerciseTitle" => "Le test de votre vie",
            "questionId" => $questionId,
            "questionTitle" => "A. Lorem ipsum dolor sit amet?",
            // TODO : THIS IS TEST DATA, GET DATA FROM MODEL (AND MAYBE DIRECTLY PASS MODEL RATHER THAN A DICTIONARY)!
            "takes" => [
                [
                    "id" => 101,
                    "title" => "2020-01-01 2020-08-25 09:03:43 UTC",
                    "answer" => "Oui"
                ],
                [
                    "id" => 103,
                    "title" => "2020-01-01 2020-08-25 09:15:45 UTC",
                    "answer" => "Lorem ipsum dolor sit amet\nSunt in culpa qui officia",
                ],
                [
                    "id" => 102,
                    "title" => "2020-01-01 2020-08-25 09:05:43 UTC",
                    "answer" => "Non.",
                ]
            ]
        ];

        require_once "../ressources/views/exercises/questionResults.php";
    } 
}