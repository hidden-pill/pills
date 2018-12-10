<?php
// set order by default
$order = '`upCount`, `rv`.`date` DESC';

// change order if exist in url and in switch
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
// set search params empty
$search = '';

// check if user is connect (not same method)
if(isset($_SESSION['id'])){
    $reviews->id_users = $_SESSION['id'];
    // check if search params is set
    if(isset($_GET['search'])){
        $search = htmlspecialchars(trim($_GET['search']));
    }
    $reviews->search = $search;
    $reviewsList = $reviews->selectReviewsUserConnected($order);
}else{ 
    // check if search params is set
    if(isset($_GET['search'])){
        $search = htmlspecialchars(trim($_GET['search']));
    }
    $reviews->search = $search;
    $reviewsList = $reviews->selectReviews($order);
}
