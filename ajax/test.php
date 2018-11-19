<?php
include_once '../config.php';
$a = ['sum' => 21, 'color' => 0];
echo json_encode($a);

/*
if(isset($_POST['test'])){
    $sum = new Upvotes();
    $vote->id_users = $_SESSION['id'];
    $vote->id_column = $_POST['id_column'];
    $vote->upvote = $_POST['upvote'];
    $column = $_POST['column'];
    if($vote->selectSumUpvote($column)){

        echo json_encode();
    }else{
        echo 'error';
    }
}