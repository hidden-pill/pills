<?php

class Upvotes extends Database {

    public $id = null;
    public $upvote = null;
    public $id_proposals = null;
    public $id_comments = null;
    public $id_reviews = null;
    public $id_users = null;


    public function checkIfVoteExist($column){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'upvotes` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    public function selectUpvote($column){
        $value = 0;
        $query = 'SELECT `upvote` FROM `' .SALT. 'upvotes` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $value = $selectResult->upvote;
        }
        return $value;
    }

    public function updateVote($column){/** */
        $value = 0;
        $query = 'SELECT `upvote` FROM `' .SALT. 'upvotes` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $value = $selectResult->upvote;
        }
        return $value;
    }







    /*        if($vote->checkIfVoteExist()){
            if($vote->selectUpvote() == 1){
                echo 'alreadyVote';
            } else {
                $vote->updateVote();
                echo 'success';
            }
        }else{
            if($vote->insertVote()){*/

}