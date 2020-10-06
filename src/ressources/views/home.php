<?php

$headerClass = 'home-header primary-color';

$header =
    '<div class="text-white">
        <img src="/images/logo.png">
        <h1>Exercise<br/>Looper</h1>
    </div>';

$content =
    '<div class="row">
        <div class="col-3">
            <a href="/exercises/take" class="button primary-color text-white">TAKE AN EXERCISE</a>
        </div>
        <div class="col-3">
            <a href="/exercises/new" class="button create-color text-white">CREATE AN EXERCISE</a>
        </div>
        <div class="col-3">
            <a href="/exercises" class="button manage-color text-white">MANAGE AN EXERCISE</a>
        </div>
     </div>';

require_once "../ressources/views/layout.php";