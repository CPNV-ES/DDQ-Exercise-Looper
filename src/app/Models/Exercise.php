<?php
require_once "../Db.php";

class Exercise
{
    public $id;
    private $title;
    private $state;
    private $createdAt;
    private $updatedAt;

    public function __construct() {

    }

    public function all() {

    }

    public function load() {
        if ($this->id != null)
            return false;

        
    }

    public function save() {

    }

    public function update() {

    }

    public function delete() {

    }
}