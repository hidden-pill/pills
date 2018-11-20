<?php

class ReviewsTags extends Database {

    public $id = null;

    public function insertReviewTag(){
        $query = 'INSERT INTO `' .SALT. 'reviewsTags`'
        . '(`id_reviews`, `id_tags`)'
        . 'VALUES'
        . '(:id_reviews, :id_tags)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':id_tags', $this->id_tags, PDO::PARAM_INT);
        $artistJob->bindValue(':id_reviews', $this->reviewID, PDO::PARAM_INT);
        return $artistJob->execute();
    }

    public function deleteReviewsTagsToDeleteUser(){
        $state = false;
        $query = 'DELETE FROM  `' .SALT. 'reviewsTags` WHERE `id_reviews` = :id_reviews';
        $delete = Database::getInstance()->prepare($query);
        $delete->bindValue(':id_reviews', $this->id_reviews, PDO::PARAM_INT);
        if ($delete->execute()) { 
            $state = true;
        }
        return $state;
    }

}