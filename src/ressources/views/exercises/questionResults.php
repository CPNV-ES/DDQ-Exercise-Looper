<?php

$headerClass = 'header-basic bg-primary';

$header = "<span><a href='/exercises/{$data['exerciseId']}/results'>Exercise {$data['exerciseTitle']}</a></span>";

$answers = "<table><tr><th>Take</th><th>Answer</th></tr>";

foreach($data["takes"] as $take) {
    $answers .= "<tr>";
    $answers .= "<td><a href='/exercises/{$data['exerciseId']}/take/{$take['id']}'> {$take['title']} </a></td>";
    $answers .= "<td>{$take['answer']}</td>";
    $answers .= "</tr>"; 
}

$answers .= "</table>";

$content = '
    <div class="row">
        <div class="col-1">
            <p class="page-title">' . $data['questionTitle'] . '</p>
            <dl>
                ' . $answers . '
            </dl>
        </div>
    </div>';

require_once "../ressources/views/layout.php";