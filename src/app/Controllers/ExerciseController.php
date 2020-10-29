<?php

class ExerciseController {

    /**
     * This method gets all the exercises and displays it on the manage view
     */
    public function manage() {

        // Todo : add the call method all() from the ExerciseModel

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

        // Todo : add the call method all() from the ExerciseModel
        require_once "../ressources/views/exercises/listAnswering.php";
    }

    public function takeNew($exerciseId) {
        $data = [
            "exerciseId" => $exerciseId,
            // TODO : THIS IS TEST DATA, GET DATA FROM MODEL (AND MAYBE DIRECTLY PASS MODEL RATHER THAN A DICTIONARY)!
            "questionfields" => [
                [
                    "id" => 1,
                    "label" => "Test1",
                    "valueType" => "Single line text",
                ],
                [
                    "id" => 2,
                    "label" => "Test2",
                    "valueType" => "List of single lines"
                ],
                [
                    "id" => 3,
                    "label" => "Test3",
                    "valueType" => "List of Multi-line text"
                ]
            ]
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

        require_once "../ressources/views/exercises/listAnswering.php";
    }

    /**
     * This method stores the created exercise
     */
    public function store() {

        // Todo : insert data into database

        header("Location: /exercises/1/questions-fields");
    }

    public function exerciseResults($exerciseId) {
        $data = [
            "exerciseId" => $exerciseId,
            // TODO : THIS IS TEST DATA, GET DATA FROM MODEL (AND MAYBE DIRECTLY PASS MODEL RATHER THAN A DICTIONARY)!
            "questions" => [
                100 => "A. Lorem ipsum dolor sit amet?",
                102 => "C. Ut enim ad minim veniam, aute irure dolor ?",
                101 => "B. Sunt in culpa qui officia?",
            ],
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
}