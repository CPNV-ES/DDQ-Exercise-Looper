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

        require_once "../ressources/views/exercises/take.php";
    }

    /**
     * This method stores the created exercise
     */
    public function store() {

        // Todo : insert data into database

        header("Location: /exercises/1/questions-fields");
    }
}