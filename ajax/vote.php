<?php
include_once '../config.php';
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    if(isset($_POST['upvote']) && !empty($_POST['id_column'])){
        $vote = new Upvotes();
        $vote->id_users = $id;
        $vote->id_column = $_POST['id_column'];
        $vote->upvote = $_POST['upvote'];
        $column = $_POST['column'];
        if($vote->checkIfVoteExist($column)){
            if($vote->selectVote($column) == $_POST['upvote']){
                if($vote->deleteVote($column)){
                    echo 'del';
                }else{
                    echo 'error';
                }
            } else {
                if($vote->updateVote($column)){
                    echo 'success';
                } else {
                    echo 'Error';
                }
            }
        }else{
            if($vote->insertVote($column)){
                echo 'success';
            } else {
                echo 'Error';
            }
        }
    }
} else {
    echo 'nosession';
}