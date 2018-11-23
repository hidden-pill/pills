<?php
include_once '../config.php';
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    if(isset($_POST['upvote']) && !empty($_POST['id_column'])){
        $rewardUser = new Users();
        $rewardUser->id = $id;
        $rewardUser->rewardID = 1;
        $vote = new Upvotes();
        $vote->id_users = $id;
        $vote->id_column = $_POST['id_column'];
        $vote->upvote = $_POST['upvote'];
        $column = $_POST['column'];
        if($vote->checkIfVoteExist($column)){
            if($vote->selectVote($column) == $_POST['upvote']){
                if($vote->deleteVote($column)){
                    if($rewardUser->deleteUserReward()){
                        $jsonReturn = ['sum' => $vote->selectTotalVote($column), 'action' => 'del', 'button' => $_POST['upvote'], 'item' => $_POST['id_column']];
                        echo json_encode($jsonReturn);
                    }else {
                        echo json_encode(['error' => 'error']);
                    }
                }else{
                    echo json_encode(['error' => 'error']);
                }
            } else {
                if($vote->updateVote($column)){
                    $jsonReturn = ['sum' => $vote->selectTotalVote($column), 'action' => 'upd', 'button' => $_POST['upvote'], 'item' => $_POST['id_column']];
                    echo json_encode($jsonReturn);
                } else {
                    echo json_encode(['error' => 'error']);
                }
            }
        }else{
            if($vote->insertVote($column)){
                if($rewardUser->addUserReward()){
                    $jsonReturn = ['sum' => $vote->selectTotalVote($column), 'action' => 'ins', 'button' => $_POST['upvote'], 'item' => $_POST['id_column']];
                    echo json_encode($jsonReturn);
                }else {
                    echo json_encode(['error' => 'error']);
                }
            } else {
                echo json_encode(['error' => 'error']);
            }
        }
    }
} else {
     echo json_encode(['error' => 'nossession']);
}