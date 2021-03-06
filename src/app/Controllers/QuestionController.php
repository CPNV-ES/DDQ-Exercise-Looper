<?php 

require_once dirname(__DIR__,1).'/Models/QuestionField.php';

class QuestionController {
  function index($id){
    $questionFieldsModel = new QuestionField();

    $questionFields = $questionFieldsModel->findByExercise($id);

    require_once "../ressources/views/questions/index.php";
  }

  function store($id){
    $questionFieldsModel = new QuestionField();
    $questionFieldsModel->insert([$_POST['label'],$id,$_POST['value']]);
    header('Location:/exercises/'.$id.'/questions-fields');
  }

  function edit($idExercice,$idField){
    $questionFieldsModel = new QuestionField();
    $questionField = $questionFieldsModel->find($idField);

    require_once "../ressources/views/questions/edit.php";
  }

  function update($idExercice,$idField) {
    $questionFieldsModel = new QuestionField();
    $questionFieldsModel->update($idField, [$_POST['label'],$_POST['value']], ['label', 'valueType']);
    header('Location:/exercises/'.$idExercice.'/questions-fields');
  }

  function delete($idExercice,$idField){
    $questionFieldsModel = new QuestionField();
    $questionFieldsModel->delete($idField);
    header('Location:/exercises/'.$idExercice.'/questions-fields');
  }
}