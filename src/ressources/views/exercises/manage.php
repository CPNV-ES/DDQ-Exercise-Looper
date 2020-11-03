<?php

$headerClass = 'header-basic bg-manage';

$header = '';

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
                    <tr>
                        <td>test</td>
                        <td><a href="#"><i class="far fa-chart-bar"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <span class="page-title">Answering</span>
        </div>
        <div class="col-3">
            <span class="page-title">Closed</span>
        </div>
    </div>';

require_once "../ressources/views/layout.php";