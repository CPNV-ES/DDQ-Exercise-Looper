<?php

use PHPUnit\Framework\TestCase;
use App\Models\Model;

class ModelTest extends TestCase {

    protected $dbConnection;
    protected $model;
    
    public function _construct(){
        $this->dbConnection = new PDO('mysql:host=localhost;dbname=test','root','');
        $this->model = new Model($this->dbConnection,true);
    }

    /**
     * @dataProvider insertProvider
     */
    public function insertDatabase($name,$firstname,$birthday){
        $data = [$name,$firstname,$birthday];

        $this->model->insert($data);
    }

    
    public function allTest(){
        $receiveData = $this->model->all();
    }

    
    

    public function insertProvider(){
        return [
            [
                ['aellen','quentin','06/18/2001'],
                ['burnat','mathieux','08/05/1993'],
                ['imfeld','dimitri','02/15/1996']
            ]
        ];
    }

    
} 