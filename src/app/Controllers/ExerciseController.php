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
}