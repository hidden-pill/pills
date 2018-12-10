<?php

class ReviewsTags extends Database {

    public $id = null;

    /**
     * insert review and tag ids into table reviewsTags
     * @return bool
     */
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


}