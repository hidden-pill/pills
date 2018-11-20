<?php
$order = '`upCount`, `rv`.`date` DESC';

if(isset($_GET['order'])){
    $orderSwitch = htmlspecialchars($_GET['order']);
    switch($orderSwitch) {
        case 'trending':
            $order = '`upCount`, `rv`.`date` DESC';
            break;        
        case 'new':
            $order = '`rv`.`date` DESC';
            break;        
        case 'top':
            $order = '`upCount` DESC';
            break;        
        case 'controversial':
            $order = '`upvoteStdDev` ASC, `upvoteCount` DESC';
            break;
    }
}
$reviews = new Reviews();
if(isset($_SESSION['id'])){
    if(is_numeric($_SESSION['id'])){
        $reviews->id_users = $_SESSION['id'];
        $reviewsList = $reviews->selectReviewsUserConnected($order);
    }else{
        $reviewsList = $reviews->selectReviews($order);
    }
}else{
    $reviewsList = $reviews->selectReviews($order);
}
