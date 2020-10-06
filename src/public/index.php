<?php

require ('../app/Models/model.php');

/* $webrouter = new Router($_SERVER['REQUEST_URI']);

$webrouter->get(['/','HomeController@index']); */


$test = new Model(new PDO('mysql:dbname=testdb;host=localhost:3306','root',''),true);

var_dump($test->all());