<?php

$culturalObject = '';
$title = '';
$review = '';
$image = '';
$errorReviewForm = [];

$culturalObject = new CulturalObjects();
$coList = $culturalObject->selectCulturalObjects();

if(isset($_POST['submitReview'])){
    if (!empty($_POST['culturalObject'])) {
        $culturalObject = htmlspecialchars($_POST['culturalObject']);
    }else{
        $errorReviewForm['culturalObject'] = 'ERROR_CO';
    }

    if (!empty($_POST['title'])) {
        $title = htmlspecialchars($_POST['title']);
    }else{
        $errorReviewForm['title'] = 'ERROR_TITLE';
    }

    if (!empty($_POST['review'])) {
        $review = htmlspecialchars($_POST['review']);
    }else{
        $errorReviewForm['review'] = 'ERROR_REVIEW';
    }

    if (count($errorReviewForm) == 0) {
        $newReview = new Reviews();
        $newReview->id_culturalObjects = $culturalObject;
        $newReview->title = $title;
        $newReview->review = $review;
        $newReview->image = $image;
        $newReview->id_users = $_SESSION['id'];
        if(!$newReview->insertReview()){
            echo 'raté';
        }
    }
}