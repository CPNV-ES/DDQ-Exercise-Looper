<?php

$webrouter = new Router($_SERVER['REQUEST_URI']);

$webrouter->get(['/','HomeController@index']);

$webrouter->get(['/','HomeController@index']);

