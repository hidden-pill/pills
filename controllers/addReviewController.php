<?php

$title = '';
$review = '';
$tagsArray = [];
$tagsInputArray = [];
$newTagsArray = [];

$errorReviewForm = [];

$artwork = new Artworks();
$artworksList = $artwork->selectArtworks();
$tags = new Tags();
$tagsList = $tags->selectTags();
var_dump($_POST);

if(isset($_POST['submitReview']) && isset($_SESSION['id'])){
    $id = htmlspecialchars($_SESSION['id']);
    if (!empty($_POST['artwork'])) {
        $artwork = htmlspecialchars($_POST['artwork']);
    }else{
        $errorReviewForm['artwork'] = 'ERROR_ARTWORK';
    }

    if (!empty($_POST['title'])) {
        $title = htmlspecialchars($_POST['title']);
    }else{
        $errorReviewForm['title'] = 'ERROR_TITLE';
    }

    if((count($_POST['tagInputs']) != 0) && (!empty($_POST['tags']))){
        foreach($_POST['tagInputs'] as $tagInput){
            $tagInput = htmlspecialchars($tagInput);
            $tagsInputArray[] = $tagInput;
        }
        foreach($_POST['tags'] as $tag){
            if(!is_numeric($tag)){
                $errorReviewForm['tags'] = 'ERROR_TAGS';
            } else {
                $tagsArray[] = $tag;
            }
        }
    } else {
        $errorReviewForm['tags'] = 'ERROR_EMPTY_TAG';
    }

    if (!empty($_FILES['image']['name'])) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            if(pathinfo($_FILES['image']['name'])['extension'] == 'png' || pathinfo($_FILES['image']['name'])['extension'] == 'jpg'){
                $image = $_FILES['image'];
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
        $newReview->id_artworks = $artwork;
        $newReview->title = $title;
        $newReview->review = $review;
        $newReview->id_users = $id;
        $newTags = new Tags();
        $newReviewTag = new ReviewsTags();
        try {
            Database::getInstance()->beginTransaction();
            $newReview->insertReview();
            $reviewID = $newReview->getLastInsertId();

            foreach ($tagsInputArray as $tagInput) {
                $newTags->tag = $tagInput;
                $newTags->insertTag();
                $newTagsArray[] = $newTags->getLastInsertId();
            }

            foreach ($newTagsArray as $newTag) {
                $newReviewTag->id_tags = $newTag;
                $newReviewTag->reviewID = $reviewID;
                $newReviewTag->insertReviewTag();
            }

            foreach ($tagsArray as $tag) {
                $newReviewTag->id_tags = $tag;
                $newReviewTag->reviewID = $reviewID;
                $newReviewTag->insertReviewTag();
            }

            if(isset($image)){
                $first_path = $image['tmp_name'];
                $end_path = '../assets/images/reviews/' .$reviewID;
                move_uploaded_file($first_path, $end_path);
            }
            Database::getInstance()->commit();
        } catch (Exception $e) { // catch error message
            Database::getInstance()->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    }
}