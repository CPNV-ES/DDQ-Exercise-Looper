<?php

$headerClass = 'header-basic bg-primary';

$header = '<span>Exercise ' . $data["exerciseId"] . '</span>';

$_fields = "";
foreach($data["questionfields"] as $field) {
    $_val = isset($field["answer"]) ? $field["answer"] : "";
    $_fields .= "<div class='fieldContainer'>";
    $_fields .= "<label for='{$field['id']}'>{$field['label']}</label>";
    switch($field["valueType"]) {
        case "Single line text":
            $_fields .= "<input class='input-text' name='answers[{$field['id']}]' id='{$field['id']}' type='text' value='{$_val}' />";
            break;
        case "Multi-line text":
            $_fields .= "<textarea class='input-text' name='answers[{$field['id']}]' id='{$field['id']}' rows='5'>{$_val}</textarea>";
            break;
        case "List of single lines":
            $_fields .= "<textarea class='input-text' name='answers[{$field['id']}]' id='{$field['id']}' rows='5'>{$_val}</textarea>";
            break;
    }
    $_fields .= "</div>";
}
$action = isset($data["takeId"]) ?
        '/exercises/updateTakeAnswersData/'.$data["exerciseId"].'/'.$data["takeId"]:
        '/exercises/storeTakeAnswersData/'.$data["exerciseId"];
$content =
    '<div class="row">
        <div class="col-1">
        <form action="'.$action.'" method="POST">
            <p class="page-title">Your Take</p>'

            . (isset($data["takeId"]) ?
                "<p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>" :
                "<p>If you'd like to come back later to finish, simply submit it with blanks.</p>")

            . $_fields

            .'<div class="col-5"> <input class="button bg-primary text-white" type="submit" /> </div>
        </form>
        </div>
    </div>
    ';

require_once "../ressources/views/layout.php";