<?php

$headerClass = 'basic-header bg-primary';

$header = '';
$content = '
<div class="row">
    <div class="col-1">
        <form action="/exercises/'.$idExercice.'/questions-fields/'.$questionField[0]['id'].'" method="POST">
            <label class="input-title" for="label">Label</label>
            <input id="label" class="input-text" name="label" type="text" value="'.$questionField[0]['label'].'" required/>

            <label class="input-title" for="valuekind">Value kind</label>
            <select class="input-text" id="valuekind" name="value">
                <option value="Single line text" '.($questionField[0]['valueType']=='Single line text'?'selected':'').'>Single line text</option>
                <option value="Multi-line text" '.($questionField[0]['valueType']=='Multi-line text'?'selected':'').'>Multi-line text</option>
                <option value="List of single lines" '.($questionField[0]['valueType']=='List of single lines'?'selected':'').'>List of single lines</option>
            </select>

            <input class="button bg-primary text-white" type="submit" name="commit" value="Create Question field">
        </form>
    </div>
</div>
';

require_once "../ressources/views/layout.php";