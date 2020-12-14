<?php

require_once "Model.php";

class Fulfillment extends Model {
  protected $table = 'Fulfillments';
  protected $foreignKeys = [
    ['answersId' => 'answers.id'],
    ['exercisesId' => 'exercises.id'],
    ['takesId' => 'takes.id']
  ];
  protected $readables = ['answers.answer','exercises.title','exercises.state','takes.title'];
  protected $writables = ['answersId','exercisesId','takesId','updatedAt'];

  public function __construct(){
    parent::__construct();
  }
}