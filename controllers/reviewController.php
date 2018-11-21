<?php 

if(isset($_GET['review'])){
    $reviewID = $_GET['review'];
    $review = new Reviews();
    $review->id = $reviewID;
    if($review->checkIfReviewExist()){
        if(isset($_SESSION['id'])){
            $review->id_users = $_SESSION['id'];
            $reviewDetails = $review->selectReviewUserConnected();
        }else{
            $reviewDetails = $review->selectReview();
        }
    }else{
        header('Location:/');
        exit;
    }
}else {
    header('Location:/');
    exit;
}