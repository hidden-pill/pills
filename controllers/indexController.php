<?php
$order = '`upCount`, `rv`.`date` DESC';

if(isset($_GET['order'])){
    $orderSwitch = htmlspecialchars($_GET['order']);

}
$reviews = new Reviews();
$reviewsList = $reviews->selectReviews($order);


