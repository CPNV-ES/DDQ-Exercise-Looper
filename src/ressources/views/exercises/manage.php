<?php

$headerClass = 'header-basic bg-manage';

$header = '';

$building = '';
$answering = '';
$closed = '';

foreach($exercises as $exercise){
    switch($exercise['state']){
        case 'Building':
            $building .= '
                <tr>
                    <td>'.$exercise['title'].'</td>
                    <td>
                        <a href="/exercises/'.$exercise['id'].'/questions-fields">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="/exercises/'.$exercise['id'].'/delete">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a title="Be ready for answers" data-method="put" href="/exercises/'.$exercise['id'].'/setState/answering">
                            <i class="fa fa-comment"></i>
                        </a>
                    </td>
                </tr>
            ';
            break;
        case 'Answering':
            $answering .= '
                <tr>
                    <td>'.$exercise['title'].'</td>
                    <td>
                        <a href="/exercises/'.$exercise['id'].'/results">
                            <i class="far fa-chart-bar"></i>
                        </a>
                        <a title="Close" data-method="put" href="/exercises/'.$exercise['id'].'/setState/closed">
                            <i class="fa fa-minus-circle"></i>
                        </a>
                    </td>
                </tr>
            ';
            break;
        case 'Closed':
            $closed .= '
                <tr>
                    <td>'.$exercise['title'].'</td>
                    <td>
                        <a href="/exercises/'.$exercise['id'].'/results">
                            <i class="far fa-chart-bar"></i>
                        </a>
                        <a href="/exercises/'.$exercise['id'].'/delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            ';
            break;
    }
}


$content = '
    <div class="row">
        <div class="col-3">
            <span class="page-title">Building</span>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    '.$building.'
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <span class="page-title">Answering</span>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    '.$answering.'
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <span class="page-title">Closed</span>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    '.$closed.'
                </tbody>
            </table>
        </div>
    </div>';

require_once "../ressources/views/layout.php";