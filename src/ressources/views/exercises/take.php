<?php

$headerClass = 'basic-header primary-color';

$header = '';

$content =
    '<div class="row">
        <div class="column">
            <a href="/exercises/take" class="button primary-color text-white">TAKE AN EXERCISE</a>
        </div>
        <div class="column">
            <a href="/exercises/new" class="button create-color text-white">CREATE AN EXERCISE</a>
        </div>
        <div class="column">
            <a href="/exercises" class="button manage-color text-white">MANAGE AN EXERCISE</a>
        </div>
     </div>';

require_once "layout.php";