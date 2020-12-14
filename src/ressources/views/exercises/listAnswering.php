<?php

$headerClass = 'header-basic bg-primary';

$header = '';

$content = '';

foreach($exercises as $exercise){
    $content .= 
    '
    <div class="container-rounded bg-grey">
        <div class="row">
            <div class="col-1">
                <div class="container color">
                    <span>'. $exercise['title'] .'</span>
                    <a class="button bg-primary text-white" href="/exercises/'. $exercise['id'] .'/take/new">TAKE IT</a>
                </div>
            </div>
        </div>
    </div>
    ';
}

require_once "../ressources/views/layout.php";