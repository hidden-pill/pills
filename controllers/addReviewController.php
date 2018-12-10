<?php
// initialize variables / arrays
$title = '';
$review = '';
$tagsArray = [];
$tagsInputArray = [];
$newTagsArray = [];
$errorReviewForm = [];

// all instances for all selectors
$artwork = new Artworks();
$artworksList = $artwork->selectArtworks();
$tags = new Tags();
$tagsList = $tags->selectTags();

// submit review
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

    // check if review get one tag at least
    if((count($_POST['tagInputs']) != 0) || (!empty($_POST['tags']))){
        foreach($_POST['tagInputs'] as $tagInput){
            $tagInput = htmlspecialchars($tagInput);
            $tagsInputArray[] = $tagInput;
        }
            if(!empty($_POST['tags'])){
            foreach($_POST['tags'] as $tag){
                if(!is_numeric($tag)){
                    $errorReviewForm['tags'] = 'ERROR_TAGS';
                } else {
                    $tagsArray[] = $tag;
                }
            }
        }
    } else {
        $errorReviewForm['tags'] = 'ERROR_EMPTY_TAG';
    }

    // if image exists, upload it only if extension if jpg and png
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

    // try to insert in db if error array still empty after all tests
    if (count($errorReviewForm) == 0) {
        $newReview = new Reviews();
        $newReview->id_artworks = $artwork;
        $newReview->title = $title;
        $newReview->review = $review;
        $newReview->id_users = $id;

        $newTags = new Tags();
        $newReviewTag = new ReviewsTags();

        // transaction
        try {
            //start
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
            // execute all insert if there is no problems
            Database::getInstance()->commit();
        } catch (Exception $e) {
            Database::getInstance()->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    } else {
        var_dump($errorReviewForm);
    }
}