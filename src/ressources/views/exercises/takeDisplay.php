<?php

$headerClass = 'header-basic bg-primary';

$header = "<span><a href='/exercises/{$data['exerciseId']}/results'>Exercise {$data['exerciseId']}</a></span>";

$questions = "";

foreach($data["questionsAnswers"] as $qa) {
    $questions .= "<dt>{$qa['question']}</dt>";
    $questions .= "<dd>{$qa['answer']}</dt>";
}

$content = '
    <div class="row">
        <div class="col-1">
            <p class="page-title">' . $data['exerciseTitle'] . '</p>
            <dl>
                ' . $questions . '
            </dl>
        </div>
    </div>';

require_once "../ressources/views/layout.php";