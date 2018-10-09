<?php

$checkTrending = null;
$checkHot = null;
$checkCreated = null;
$checkCommented = null;

if(isset($_GET['filter'])){
    switch($_GET['filter']) {
    case 'trending':
        $checkTrending = 'class="active"';
        break;
    case 'hot':
        $checkHot = 'class="active"';
        break;
    case 'created':
        $checkCreated = 'class="active"';
        break;
    case 'commented':
        $checkCommented = 'class="active"';
        break;
    }
}