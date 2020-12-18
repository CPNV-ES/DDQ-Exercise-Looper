<?php

$headerClass = 'header-basic bg-manage';

$header = "<span><a href='/exercises/{$data['exerciseId']}/results'>Exercise {$data['exerciseTitle']}</a></span>";

$questions = "";

foreach($data["questionsAnswers"] as $qa) {
    $questions .= "<dt>{$qa['label']}</dt>";
    $questions .= "<dd>{$qa['answer']}</dt>";
}

$content = '
    <div class="row">
        <div class="col-1">
            <p class="page-title">' . $data['takeTitle'] . '</p>
            <dl>
                ' . $questions . '
            </dl>
        </div>
    </div>';

require_once "../ressources/views/layout.php";