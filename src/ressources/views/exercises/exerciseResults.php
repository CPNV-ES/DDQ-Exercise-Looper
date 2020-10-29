<?php

$headerClass = 'header-basic bg-primary';

$header = '<span>Exercise ' . $data["exerciseId"] . '</span>';

$_table = "<table><tr><th>Take</th>";

// Sort questions by id
ksort($data["questions"]);

// Sort takes by id
ksort($data["takes"]);

foreach($data["questions"] as $questionId => $questionTitle) {
    $_table .= "<th><a href='/exercices/{$data['exerciseId']}/results/{$questionId}'>{$questionTitle}</a></th>";
}

foreach($data["takes"] as $takeId => $takeData) {
    // Sort answers by id
    ksort($takeData["questionsTakes"]);

    $_table .= "<tr>";
    $_table .= "<td><a href='/exercices/{$data['exerciseId']}/take/{$takeId}'> {$takeData['title']} </a></td>";
    foreach($takeData["questionsTakes"] as $questionsTakeId => $questionTakeFulfillment) {
        $_table .= "<td>{$questionTakeFulfillment}</td>";
    }

    $_table .= "</tr>";
}

$_table .= "</tr>";
$_table .= "</table>";

$content =
'<div class="row">
    <div class="col-1">
        ' .$_table . '
    </div>
</div>';

require_once "../ressources/views/layout.php";