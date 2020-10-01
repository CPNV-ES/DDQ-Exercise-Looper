<?php

class ExerciseController {

    /**
     * This method gets all the exercises and displays it on the manage view
     */
    public function index() {

        // Todo : add the call method all() from the ExerciseModel

        require_once "../ressources/views/exercises/manage.php";
    }

    /**
     * This method displays the view to create an exercise
     */
    public function new() {
        require_once "../ressources/views/exercises/create.php";
    }

    /**
     * This method gets all the exercises and displays it on the take view
     */
    public function take() {

        // Todo : add the call method all() from the ExerciseModel
        
        require_once "../resources/views/exercices/take.php";
    }
}