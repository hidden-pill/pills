<?php
//include config to get session and all models
include_once '../config.php';

//check if user is connect
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $newComment = new Comments();
    $newComment->id_users = $id;
    $rewardUser = new Users();
    $rewardUser->id = $id;
    //set reward 2 (25xp)
    $rewardUser->rewardID = 2;

    //check if js data are received
    if(!empty($_POST['id_column']) && !empty($_POST['column']) && !empty($_POST['comment'])){

        $newComment->comment = $_POST['comment'];
        $newComment->id_column = $_POST['id_column'];
        $column = $_POST['column'];
        // insert comment in db
        $newComment->insertComment($column);
            // add xp to user
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
