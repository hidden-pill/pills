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

    public function selectReviews($order) {
        $reviews = [];
        $query = 'SELECT'
                    . '`rv`.`id`,'
                    . '`rv`.`title`,'
                    . '`rv`.`review`,'
                    . '`rv`.`date`,'
                    . '`us`.`pseudo`,'
                    . '`co`.`name`,'
                    . '`co`.`image`,'
                    . '`t`.`tag`,'
                    . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) AS `upCount`, '
                    . 'COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `downCount`,'
                    . 'COUNT(`com`.`id`) AS `comCount`'
                . 'FROM `reviews` AS `rv`'
                    . 'JOIN `users` AS `us` ON `rv`.`id_users` = `us`.`id`'
                    . 'JOIN `culturalobjects` AS `co` ON `rv`.`id_culturalobjects` = `co`.`id`'
                    . 'LEFT JOIN `reviewsTags` AS `rvt` ON `rvt`.`id_reviews` = `rv`.`id`'
                    . 'LEFT JOIN `tags` AS `t` ON `t`.`id` = `rvt`.`id_tags`'
                    . 'LEFT JOIN `upvotes` AS `up` ON `up`.`id_reviews` = `rv`.`id`'
                    . 'LEFT JOIN `comments` AS `com` ON `com`.`id_reviews` = `rv`.`id`'
                . 'GROUP BY `rv`.`id`'
                . 'ORDER BY'.$order;
        $reviews = $this->db->prepare($query);
        if($reviews->execute()){
            if (is_object($reviews)) {
                $result = $reviews->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
    
}