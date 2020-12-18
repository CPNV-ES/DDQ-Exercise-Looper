<?php

require_once "Model.php";

class Answer extends Model {
    protected $table = 'Answers';
    protected $foreignKeys = [
        ['questionsFieldsId' => 'questionFields.id'],
    ];
    protected $readables = ['id','answer','createdAt','updatedAt'];
    protected $writables = ['answer','questionsFieldsId','updatedAt'];

    public function __construct(){
        parent::__construct();
    }
}