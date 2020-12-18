<?php

require_once "Model.php";

class QuestionField extends Model {
  protected $table = 'QuestionFields';
  protected $foreignKeys = [
    ['exercisesId' => 'Exercises.id']
  ];
  protected $readables = ['id','label','valueType','createdAt','updatedAt', 'exercisesId'];
  protected $writables = ['label','exercisesId','valueType','updatedAt'];

  public function findByExerciseId($exId) {
    $q = $this->baseSelect();
    $q .= " WHERE exercisesId = ".$exId;

    $sth = $this->dbConnection->prepare($q);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function __construct(){
    parent::__construct();
  }
}