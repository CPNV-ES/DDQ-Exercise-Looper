<?php

require_once "Model.php";

class Exercise extends Model {
  protected $table = 'Exercises';
  protected $readables = ['id','title','state','createdAt','updatedAt'];
  protected $writables = ['title','state','updatedAt'];

  public function __construct(){
    parent::__construct();
  }
}