<?php

require_once "Model.php";

class QuestionField extends Model {
  protected $table = 'QuestionFields';
  protected $foreignKeys = [
    ['exercisesId' => 'Exercises.id']
  ];
  protected $readables = ['id','label','valueType','createdAt','updatedAt'];
  protected $writables = ['label','exercisesId','valueType','updatedAt'];

  public function __construct(){
    parent::__construct();
  }
  
}