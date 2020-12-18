<?php

require_once "Model.php";

class Fulfillment extends Model {
  protected $table = 'Fulfillments';
  protected $foreignKeys = [
    ['answersId' => 'answers.id'],
    ['exercisesId' => 'exercises.id'],
    ['takesId' => 'takes.id'],
    ['answers.questionsFieldsId' => 'questionFields.id']
  ];
  protected $readables = ['answers.answer', 'answers.id', 'exercises.title','exercises.state','takes.title','takesId', 'questionFields.valueType', 'questionFields.label', 'answers.questionsFieldsId'];
  protected $writables = ['answersId','exercisesId','takesId','updatedAt'];

  public function __construct(){
    parent::__construct();
  }

  public function findByTakeId($takeId) {
    $q = $this->baseSelect();
    $q .= " WHERE takesId = ".$takeId;

    $sth = $this->dbConnection->prepare($q);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findByExerciseId($exId) {
      $q = $this->baseSelect();
      $q .= " WHERE fulfillments.exercisesId = ".$exId;

      $sth = $this->dbConnection->prepare($q);
      $sth->execute();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

    public function findByExerciseIdAndQuestionId($exId, $quId) {
        $q = $this->baseSelect();
        $q .= " WHERE fulfillments.exercisesId = ".$exId. " AND questionsFieldsId = " . $quId;

        $sth = $this->dbConnection->prepare($q);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


}