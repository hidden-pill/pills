<?php

class Scores extends Database {

    public $id = null;
    public $score = null;
    public $id_artworks = null;
    public $id_artists = null;
    public $id_users = null;

    /**
     * check if score exist in scores table
     * @param column $column to choose column concern
     * @return bool
     */
    public function checkIfScoreExist($column){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'scores` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * get user score for a row in scores table
     * @param column $column to choose column concern
     * @return int
     */
    public function selectScore($column){
        $value = 0;
        $query = 'SELECT `score` FROM `' .SALT. 'scores` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $value = $selectResult->score;
        }
        return $value;
    }

    /**
     * update user score for a row in scores table
     * @param column $column to choose column concern
     * @return bool
     */
    public function updateScore($column){
        $state = false;
        $query = 'UPDATE `' .SALT. 'scores` SET `score` = :score WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':score', $this->score, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    /**
     * insert user score for a row in scores table
     * @param column $column to choose column concern
     * @return bool
     */
    public function insertScore($column) {
        $state = false;
        $query = 'INSERT INTO `' .SALT. 'scores`'
                    . '(`score`, `' .$column. '`, `id_users`)'
                    . 'VALUES '
                    . '(:score, :id_column, :id_users)';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':score', $this->score, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    
    /**
     * delete user score for a row in scores table
     * @param column $column to choose column concern
     * @return bool
     */
    public function deleteScore($column) {
        $state = false;
        $query = 'DELETE FROM  `' .SALT. 'scores` WHERE `' .$column. '` = :id_column AND `id_users` = :id_users';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    /**
     * get average score 
     * @return float
     */
    public function selectTotalScore($column){
        $value = 0;
        $query = 'SELECT TRUNCATE(AVG(`score`), 2) AS `total` FROM `' .SALT. 'scores` WHERE `' .$column. '` = :id_column';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $value = $selectResult->total;
        }
        return $value;
    }
}