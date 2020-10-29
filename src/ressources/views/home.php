<?php

$headerClass = 'header-home bg-primary';

$header = '
    <div class="text-white">
        <h1>Exercise<br/>Looper</h1>
    </div>';

$content = '
    <div class="row">
        <div class="col-3">
            <a href="/exercises/listAnswering" class="button bg-primary text-white">Take an exercise</a>
        </div>
        <div class="col-3">
            <a href="/exercises/new" class="button bg-create text-white">Create an exercise</a>
        </div>
        <div class="col-3">
            <a href="/exercises" class="button bg-manage text-white">Manage an exercise</a>
        </div>
    </div>';

require_once "../ressources/views/layout.php";