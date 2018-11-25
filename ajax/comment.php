<?php
include_once '../config.php';

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $newComment = new Comments();
    $newComment->id_users = $id;
    $rewardUser = new Users();
    $rewardUser->id = $id;
    $rewardUser->rewardID = 2;

    if(!empty($_POST['id_column']) && !empty($_POST['column']) && !empty($_POST['comment'])){

        $newComment->comment = $_POST['comment'];
        $newComment->id_column = $_POST['id_column'];
        $column = $_POST['column'];
        $newComment->insertComment($column);
            if($rewardUser->addUserReward()){
                echo json_encode(['test' => $_POST['comment']]);
            }else{
                echo json_encode(['error' => 'error']);
            }
    }else{
        echo json_encode(['error' => 'error']);
    }
}else{
    echo json_encode(['error' => 'nosession']);
}
