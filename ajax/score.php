<?php
include_once '../config.php';
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];

    if(isset($_POST['score']) && !empty($_POST['id_column']) && !empty($_POST['column'])){
        $rewardUser = new Users();
        $rewardUser->id = $id;
        $rewardUser->rewardID = 1;
        $score = new Scores();
        $score->id_users = $id;
        $score->id_column = $_POST['id_column'];
        $score->score = $_POST['score'];
        $column = $_POST['column'];
        if($score->checkIfScoreExist($column)){
            if($score->selectScore($column) == $_POST['score']){
                if($score->deleteScore($column)){
                    if($rewardUser->deleteUserReward()){
                        $jsonReturn = ['sum' => $score->selectTotalScore($column), 'action' => 'del', 'button' => $_POST['score'], 'item' => $_POST['id_column'], 'column' => $column];
                        echo json_encode($jsonReturn);
                    }else {
                        echo json_encode(['error' => 'error']);
                    }
                }else{
                    echo json_encode(['error' => 'error']);
                }
            } else {
                if($score->updateScore($column)){
                    $jsonReturn = ['sum' => $score->selectTotalScore($column), 'action' => 'upd', 'button' => $_POST['score'], 'item' => $_POST['id_column'], 'column' => $column];
                    echo json_encode($jsonReturn);
                } else {
                    echo json_encode(['error' => 'error']);
                }
            }
        }else{
            if($score->insertScore($column)){
                if($rewardUser->addUserReward()){
                    $jsonReturn = ['sum' => $score->selectTotalScore($column), 'action' => 'ins', 'button' => $_POST['score'], 'item' => $_POST['id_column'], 'column' => $column];
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