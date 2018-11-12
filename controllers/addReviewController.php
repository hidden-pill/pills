<?php

$culturalObject = '';
$title = '';
$review = '';
$image = '';
$errorReviewForm = [];

$culturalObject = new CulturalObjects();
$coList = $culturalObject->selectCulturalObjects();

if(isset($_POST['submitReview']) && isset($_SESSION['id'])){
    $id = htmlspecialchars($_SESSION['id']);
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

    if (!empty($_FILES['image'])) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $image = $_FILES['image'];
            if(pathinfo($image['name'])['extension'] != 'png'){
                echo 'no';
            }
        }
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
        $newReview->id_users = $id;
        if(!$newReview->insertReview()){
            echo 'raté';
        } else{
            $first_path = $image['tmp_name'];
            $end_path = '../assets/images/artworks/' .$newReview->getLastInsertId(). '.png';
            if (!move_uploaded_file($first_path, $end_path)) {
                echo 'yee';
            }
        }
    }
}