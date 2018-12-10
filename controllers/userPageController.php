<?php
//check if pseudo params exists
if(isset($_GET['pseudo'])){
    $pseudo = htmlspecialchars($_GET['pseudo']);
    $userpage = new Users();
    $userComments = new Comments();
    $userReviews = new Reviews();
    $userpage->pseudo = $pseudo;
    $userComments->pseudo = $pseudo;
    $userReviews->pseudo = $pseudo;
    // if pseudo didn't exist in db redirect to homepage
    if(!$userpage->checkIfPseudoExist()){
        header('Location:/');
        exit;
    }
    // get all content for user page
    $userDetails = $userpage->selectUser();
    $lastUserComments = $userComments->selectLastUserComments();
    $lastUserReviews = $userReviews->selectLastUserReviews();
} else { // if params is empty, redirect to homepage
    header('Location:/');
    exit;
}