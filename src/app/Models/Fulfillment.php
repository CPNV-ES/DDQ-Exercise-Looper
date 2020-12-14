<?php

require_once "Model.php";

class Fulfillment extends Model {
  protected $table = 'Fulfillments';
  protected $foreignKeys = [
    ['Answers_id' => 'answers.id'],
    ['Exercises_id' => 'exercises.id'],
    ['Takes_id' => 'takes.id']
  ];
  protected $readables = ['answers.answer','exercises.title','exercises.state','takes.title'];
  protected $writables = ['Answers_id','Exercies_id','Takes_id','updatedAt'];

  public function __construct(){
    parent::__construct();
  }
}