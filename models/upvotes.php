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

    public function selectVote($column){
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

    public function updateVote($column){
        $state = false;
        $query = 'UPDATE `' .SALT. 'upvotes` SET `upvote` = :upvote WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':upvote', $this->upvote, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function insertVote($column) {
        $state = false;
        $query = 'INSERT INTO `' .SALT. 'upvotes`'
                    . '(`upvote`, `' .$column. '`, `id_users`)'
                    . 'VALUES '
                    . '(:upvote, :id_column, :id_users)';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':upvote', $this->upvote, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function deleteVote($column) {
        $state = false;
        $query = 'DELETE FROM  `' .SALT. 'upvotes` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function selectTotalVote($column){
        $value = 0;
        $query = 'SELECT COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `total`'
                . 'FROM `' .SALT. 'upvotes` AS `up`'
                . 'WHERE `' .$column. '` = :id_column';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $value = $selectResult->total;
        }
        return $value;
    }
}