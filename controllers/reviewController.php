<?php 

if(isset($_GET['review'])){
    $reviewID = $_GET['review'];
    $review = new Reviews();
    $comment = new Comments();
    $review->id = $reviewID;
    if($review->checkIfReviewExist()){
        if(isset($_SESSION['id'])){
            $review->id_users = $_SESSION['id'];
            $reviewDetails = $review->selectReviewUserConnected();
            $comment->id_users = $_SESSION['id'];
            $comment->id_reviews = $reviewID;
            $commentList = $comment->selectReviewCommentsUserConnected();
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