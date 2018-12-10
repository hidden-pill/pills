<?php
//include config to get session and all models
include_once '../config.php';

//check if user is connect
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    //check if js data are received
    if(isset($_POST['upvote']) && !empty($_POST['id_column'])  && !empty($_POST['column'])){
        $rewardUser = new Users();
        $rewardUser->id = $id;
        $rewardUser->rewardID = 1;
        $vote = new Upvotes();
        $vote->id_users = $id;
        $vote->id_column = $_POST['id_column'];
        $vote->upvote = $_POST['upvote'];
        $column = $_POST['column'];
        // check if user already add a vote for this
        if($vote->checkIfVoteExist($column)){
            // get id of vote already given and check if its same
            if($vote->selectVote($column) == $_POST['upvote']){
                // its same, delete in db, maybe change for an update later /!\
                if($vote->deleteVote($column)){
                    // delete xp was gave to user 
                    if($rewardUser->deleteUserReward()){
                        // return action
                        $jsonReturn = ['sum' => $vote->selectTotalVote($column), 'action' => 'del'];
                        echo json_encode($jsonReturn);
                    }else {
                        // return error
                        echo json_encode(['error' => 'error']);
                    }
                }else{
                    // return error
                    echo json_encode(['error' => 'error']);
                }
            } else {
                //change vote already send 
                if($vote->updateVote($column)){
                    // return action
                    $jsonReturn = ['sum' => $vote->selectTotalVote($column), 'action' => 'upd'];
                    echo json_encode($jsonReturn);
                } else {
                    // return error
                    echo json_encode(['error' => 'error']);
                }
            }
        }else{
            // create a row with user id and vote
            if($vote->insertVote($column)){
                // add xp to user
                if($rewardUser->addUserReward()){
                    // return action
                    $jsonReturn = ['sum' => $vote->selectTotalVote($column), 'action' => 'ins'];
                    echo json_encode($jsonReturn);
                }else {
                    // return error
                    echo json_encode(['error' => 'error']);
                }
            } else {
                // return error
                echo json_encode(['error' => 'error']);
            }
        }
    }
} else {
     echo json_encode(['error' => 'nossession']);
}

