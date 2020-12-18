<?php

$headerClass = 'basic-header bg-primary';

$questionfieldsList = '';

foreach($questionFields as $field){
  $questionfieldsList .=
  '<tr>
      <td>'.$field['label'].'</td>
      <td>'.$field['valueType'].'</td>
      <td>
        <a href="/exercises/'.$id.'/questions-fields/'.$field['id'].'/edit"><i class="fas fa-edit"></i></a>
        <a href="/exercises/'.$id.'/questions-fields/'.$field['id'].'/delete"><i class="fas fa-trash"></i></a>
      </td>
  </tr>';
}

$header = '';
$content = '
<div class="row">
    <div class="col-2">
        <span class="page-title">Question Fields</span>
        <table>
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Value kind</th>
                </tr>
            </thead>
            <tbody>
                '.$questionfieldsList.'
            </tbody>
        </table>
        <a class="button bg-primary text-white" href=""></a>
    </div>
    <div class="col-2">
        <span class="page-title">New Question Fields</span>
        <form action="/exercises/'.$id.'/questions-fields" method="POST">
            <label class="input-title" for="label">Label</label>
            <input id="label" class="input-text" name="label" type="text" required/>

            <label class="input-title" for="valuekind">Value kind</label>
            <select class="input-text" id="valuekind" name="value">
                <option value="Single line text">Single line text</option>
                <option value="Multi-line text">Multi-line text</option>
                <option value="List of single lines">List of single lines</option>
            </select>

            <input class="button bg-primary text-white" type="submit" name="commit" value="Create Question field">
        </form>
    </div>
</div>';

require_once "../ressources/views/layout.php";