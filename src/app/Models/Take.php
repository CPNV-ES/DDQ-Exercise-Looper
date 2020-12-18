<?php

require_once "Model.php";

class Take extends Model {
  protected $table = 'Takes';
  protected $foreignKeys = [];
  protected $readables = ['id','title'];
  protected $writables = ['title'];

  public function __construct(){
    parent::__construct();
  }
}