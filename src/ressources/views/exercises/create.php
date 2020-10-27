<?php

$headerClass = 'header-basic bg-create';

$header = '<span class="text-white">New exercise</span>';

$content = '
    <div class="row">
        <span class="page-title">New Exercise</span>
    </div>
    <div class="row">
        <form action="/exercises/new" method="post">
            <div class="col-1">
                <label class="input-title" for="title">Title</label>
            </div>
            <div class="col-1">
                <input class="input-text" type="text" name="title">
            </div>
            <div class="col-5">
                <input class="button bg-primary text-white" type="submit" name="commit" value="Create Exercise">
            </div>
        </form>
    </div>';

require_once "../ressources/views/layout.php";