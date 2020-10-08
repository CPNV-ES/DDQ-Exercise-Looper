<?php

$headerClass = 'home-header bg-primary';

$header = '
    <div class="text-white">
        <h1>Exercise<br/>Looper</h1>
    </div>';

$content = '
    <div class="row">
            <div class="col-3">
                <a href="/exercises/take" class="button bg-primary text-white">TAKE AN EXERCISE</a>
            </div>
            <div class="col-3">
                <a href="/exercises/new" class="button bg-create text-white">CREATE AN EXERCISE</a>
            </div>
            <div class="col-3">
                <a href="/exercises" class="button bg-manage text-white">MANAGE AN EXERCISE</a>
            </div>
        </div>';

require_once "../ressources/views/layout.php";