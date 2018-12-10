<?php
//include config to get session and all models
include_once '../config.php';

//check if user is connect
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    //check if js data are received
    if(isset($_POST['score']) && !empty($_POST['id_column']) && !empty($_POST['column'])){
        $rewardUser = new Users();
        $rewardUser->id = $id;
        $rewardUser->rewardID = 1;
        $score = new Scores();
        $score->id_users = $id;
        $score->id_column = $_POST['id_column'];
        $score->score = $_POST['score'];
        $column = $_POST['column'];
        // check if user already add a score for this
        if($score->checkIfScoreExist($column)){
            // get id of score already given and check if its same
            if($score->selectScore($column) == $_POST['score']){
                // its same, delete in db, maybe change for an update later /!\
                if($score->deleteScore($column)){
                    // delete xp was gave to user 
                    if($rewardUser->deleteUserReward()){
                        // return action
                        $jsonReturn = ['sum' => $score->selectTotalScore($column), 'action' => 'del', 'button' => $_POST['score'], 'item' => $_POST['id_column'], 'column' => $column];
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
                //change score already send 
                if($score->updateScore($column)){
                    // return action
                    $jsonReturn = ['sum' => $score->selectTotalScore($column), 'action' => 'upd', 'button' => $_POST['score'], 'item' => $_POST['id_column'], 'column' => $column];
                    echo json_encode($jsonReturn);
                } else {
                    // return error
                    echo json_encode(['error' => 'error']);
                }
            }
        }else{
            // create a row with user id and score
            if($score->insertScore($column)){
                // add xp to user
                if($rewardUser->addUserReward()){
                    // return action
                    $jsonReturn = ['sum' => $score->selectTotalScore($column), 'action' => 'ins', 'button' => $_POST['score'], 'item' => $_POST['id_column'], 'column' => $column];
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
    //else send json to js file 'cause need to be connect to add a score
    echo json_encode(['error' => 'nossession']);
}