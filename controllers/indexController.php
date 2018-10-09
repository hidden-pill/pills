<?php

$checkTrending = null;
$checkHot = null;
$checkCreated = null;
$checkCommented = null;
$class = 'class="active"';

if(isset($_GET['filter'])){
    switch($_GET['filter']) {
    case 'trending':
        $checkTrending = $class;
        break;
    case 'hot':
        $checkHot = $class;
        break;
    case 'created':
        $checkCreated = $class;
        break;
    case 'commented':
        $checkCommented = $class;
        break;
    default;
    }
}