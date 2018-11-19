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
$reviewsList = $reviews->selectReviews($order);

$vote = new Upvotes();
$vote->id_users = 1;
$vote->id_column = 1;
$vote->upvote = 1;
var_dump($vote->checkIfVoteExist('id_reviews'));
var_dump($vote->selectUpvote('id_reviews'));
