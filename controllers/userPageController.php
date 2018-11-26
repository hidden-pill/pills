<?php
if(isset($_GET['pseudo'])){
    $pseudo = htmlspecialchars($_GET['pseudo']);
    $userpage = new Users();
    $userComments = new Comments();
    $userReviews = new Reviews();
    $userpage->pseudo = $pseudo;
    $userComments->pseudo = $pseudo;
    $userReviews->pseudo = $pseudo;
    if(!$userpage->checkIfPseudoExist()){
        header('Location:/');
        exit;
    }
    $userDetails = $userpage->selectUser();
    $lastUserComments = $userComments->selectLastUserComments();
    $lastUserReviews = $userReviews->selectLastUserReviews();
} else {
    header('Location:/');
    exit;
}