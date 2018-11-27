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
$search = '';
if(isset($_SESSION['id'])){
    if(is_numeric($_SESSION['id'])){
        $reviews->id_users = $_SESSION['id'];
        if(isset($_GET['search'])){
            $search = htmlspecialchars(trim($_GET['search']));
        }
        $reviews->search = $search;
        $reviewsList = $reviews->selectReviewsUserConnected($order);
    }else{
        if(isset($_GET['search'])){
            $search = htmlspecialchars(trim($_GET['search']));
        }
        $reviews->search = $search;
        $reviewsList = $reviews->selectReviews($order);
    }
}else{
    if(isset($_GET['search'])){
        $search = htmlspecialchars(trim($_GET['search']));
    }
    $reviews->search = $search;
    $reviewsList = $reviews->selectReviews($order);
}