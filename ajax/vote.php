<?php
include_once '../config.php';
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    if(isset($_POST['plus']) && !empty($_POST['id_review'])){
        $vote = new Upvotes();
        $vote->id_users = $id;
        $vote->id_column = $_POST['id_review'];
        $vote->upvote = 1;
        if($vote->checkIfVoteExist('id_reviews')){
            if($vote->selectUpvote('id_reviews') == 1){
                echo 'alreadyVote';
            } else {
                $vote->updateVote();
                echo 'success';
            }
        }else{
            if($vote->insertVote()){
                echo 'success';
            } else {
                echo 'Error';
            }
        }
    }
} else {
    echo 'nosession';
}