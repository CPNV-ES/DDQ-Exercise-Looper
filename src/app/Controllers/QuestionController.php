<?php 

require_once dirname(__DIR__,1).'/Models/QuestionField.php';

class QuestionController {
  function index($id){
    $questionFieldsModel = new QuestionField();

    $questionFields = $questionFieldsModel->findByExercise($id);

    require_once "../ressources/views/questions/index.php";
  }

}