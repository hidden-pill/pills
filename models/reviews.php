<?php

class Reviews extends Database {

    public $id = null;
    public $title = null;
    public $review = null;
    public $date = null;
    public $image = null;

    public function __constructor() {
        parent::__construct();
    }

    public function insertReview() {
        $query = 'INSERT INTO `' .SALT. 'reviews`'
               . '(`title`, `review`, `image`, `id_users`, `id_culturalObjects`)'
               . 'VALUES '
               . '(:title, :review, :image, :id_users, :id_culturalObjects)';
        $result = $this->db->prepare($query);
        $result->bindValue(':title', $this->title, PDO::PARAM_STR);
        $result->bindValue(':review', $this->review, PDO::PARAM_STR);
        $result->bindValue(':image', $this->image, PDO::PARAM_STR);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':id_culturalObjects', $this->id_culturalObjects, PDO::PARAM_INT);
        return $result->execute();
    }

    public function selectReviews() {
        $reviews = [];
        $query = '';
        $reviews = $this->db->prepare($query);
        if($reviews->execute()){
            if (is_object($reviews)) {
                $result = $reviews->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
    
}