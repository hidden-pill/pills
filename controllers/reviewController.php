<?php 
// check if review params is set
if(isset($_GET['review'])){
    $reviewID = $_GET['review'];
    $review = new Reviews();
    $comment = new Comments();
    $review->id = $reviewID;
    // check if id review exist in db
    if($review->checkIfReviewExist()){
        // if user is connect use another method to display review
        if(isset($_SESSION['id'])){
            $review->id_users = $_SESSION['id'];
            $reviewDetails = $review->selectReviewUserConnected();
            $comment->id_users = $_SESSION['id'];
            $comment->id_reviews = $reviewID;
            $commentList = $comment->selectReviewCommentsUserConnected();
        }else{ // else simple method to display review
            $reviewDetails = $review->selectReview();
        }
    }else{ // redirect if id review didn't exist in db
        header('Location:/');
        exit;
    }
}else { // redirect if review params didnt exist in url
    header('Location:/');
    exit;
}