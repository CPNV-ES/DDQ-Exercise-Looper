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
  protected $readables = ['answers.answer', 'answers.id', 'exercises.title','exercises.state','takes.title','takesId', 'questionFields.valueType', 'questionFields.label'];
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
}