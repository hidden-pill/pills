<?php

class Reviews extends Database {

    public $id = null;
    public $title = null;
    public $review = null;
    public $date = null;

    /**
     * insert title, review, id_users, id_artworks in reviews table
     * @return bool
     */
    public function insertReview() {
        $query = 'INSERT INTO `' .SALT. 'reviews`'
                    . '(`title`, `review`, `id_users`, `id_artworks`)'
                . 'VALUES '
                    . '(:title, :review, :id_users, :id_artworks)';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':title', $this->title, PDO::PARAM_STR);
        $result->bindValue(':review', $this->review, PDO::PARAM_STR);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':id_artworks', $this->id_artworks, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * get all reviews with all additional contents
     * + search possible
     * @param order $order change order in homepage
     * @return array
     */
    public function selectReviews($order) {
        $reviews = [];
        $query = 'SELECT'
                    . '`rv`.`id`,'
                    . '`rv`.`title`,'
                    . 'SUBSTRING(`rv`.`review`, 1, 800) AS `review`,'
                    . '`us`.`id` AS `idUs`,'
                    . '`us`.`pseudo`,'
                    . '`a`.`id` AS `artworkID`,' 
                    . '`a`.`name`,'
                    . 'GROUP_CONCAT(DISTINCT `t`.`tag`) AS `tag`,'
                    . 'IF(DATEDIFF(NOW(), `rv`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`rv`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `rv`.`date`), \'j\')) AS `reviewPastTime`,'
                    . 'COUNT(`com`.`id`) AS `comCount`,'
                    . 'IF(AVG(`sc`.`score`) < 0, \'null\', TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
                    . 'IF(`red` > 0, `red`, 0) AS `red`,'
                    . 'IF(`blue` > 0, `blue`, 0) AS `blue`,'
                    . 'IF(`upvoteCount` > 0, `upvoteCount`, 0) AS `upvoteCount`,'
                    . 'IF(`upvoteTotal` != 0, `upvoteTotal`, 0) AS `upvoteTotal`,'
                    . 'IF(`upCount` > 0, `upCount`, 0) AS `upCount`,'
                    . 'IF(`upvoteStdDev` > 0, `upvoteStdDev`, 0) AS `upvoteStdDev`'
                . 'FROM `reviews` AS `rv`'
                    . 'JOIN `users` AS `us` ON `rv`.`id_users` = `us`.`id`'
                    . 'JOIN `artworks` AS `a` ON `rv`.`id_artworks` = `a`.`id`'
                    . 'LEFT JOIN `reviewsTags` AS `rvt` ON `rvt`.`id_reviews` = `rv`.`id`'
                    . 'LEFT JOIN `tags` AS `t` ON `t`.`id` = `rvt`.`id_tags`'
                    . 'LEFT JOIN ('
                        . 'SELECT'
                            . '`up`.`id_reviews` AS `upid_reviews`,'
                            . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                            . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                            . 'COUNT(`up`.`upvote`) AS `upvoteCount`,'
                            . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) AS `upCount`,'
                            . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                            . 'IF(COUNT(`up`.`upvote`) > 0, (ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) - COUNT(IF(`up`.`upvote` = 1, 1, NULL)))), 1000) AS `upvoteStdDev`'
                        . 'FROM `reviews` AS `rv`'
                            . 'LEFT JOIN `upvotes` AS `up` ON `up`.`id_reviews` = `rv`.`id`'
                            . 'GROUP BY `rv`.`id`'
                        . ') `up` ON `up`.`upid_reviews` = `rv`.`id`'
                    . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artworks` = `rv`.`id_artworks`'
                    . 'LEFT JOIN `comments` AS `com` ON `com`.`id_reviews` = `rv`.`id`'
                    . 'LEFT JOIN `AA` ON `AA`.`id_artworks` = `a`.`id`'
                    . 'LEFT JOIN `artists` AS `ats` ON `ats`.`id` = `AA`.`id_artworks`'
                    . 'WHERE `rv`.`title` LIKE :search OR `a`.`name` LIKE :search OR `ats`.`name` LIKE :search OR `t`.`tag` LIKE :search OR `us`.`pseudo` LIKE :search '
                . 'GROUP BY `rv`.`id` '
                . 'ORDER BY' .$order;
        $reviews = Database::getInstance()->prepare($query);
        $reviews->bindValue(':search', '%' .$this->search. '%', PDO::PARAM_STR);
        if($reviews->execute()){
            if (is_object($reviews)) {
                $result = $reviews->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * get all reviews with all additional contents
     * + user concern
     * + search possible
     * @param order $order change order in homepage
     * @return array
     */
    public function selectReviewsUserConnected($order){
        $reviews = [];
        $query = 'SELECT'
                . '`rv`.`id`,'
                . '`rv`.`title`,'
                . 'SUBSTRING(`rv`.`review`, 1, 800) AS `review`,'
                . '`us`.`id` AS `idUs`,'
                . '`us`.`pseudo`,'
                . '`a`.`id` AS `artworkID`,'
                . '`a`.`name`,'
                . 'GROUP_CONCAT(DISTINCT `t`.`tag`) AS `tag`,'
                . 'IF(DATEDIFF(NOW(), `rv`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`rv`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `rv`.`date`), \'j\')) AS `reviewPastTime`,'
                . 'COUNT(`com`.`id`) AS `comCount`,'
                . 'IF(AVG(`sc`.`score`) < 0, \'null\', TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
                . 'IF(`red` > 0, `red`, 0) AS `red`,'
                . 'IF(`blue` > 0, `blue`, 0) AS `blue`,'
                . 'IF(`upvoteCount` > 0, `upvoteCount`, 0) AS `upvoteCount`,'
                . 'IF(`upvoteTotal` != 0, `upvoteTotal`, 0) AS `upvoteTotal`,'
                . 'IF(`upCount` > 0, `upCount`, 0) AS `upCount`,'
                . 'IF(`upvoteStdDev` > 0, `upvoteStdDev`, 0) AS `upvoteStdDev`,'
                . '`classupvote`'
            . 'FROM `reviews` AS `rv`'
                . 'JOIN `users` AS `us` ON `rv`.`id_users` = `us`.`id`'
                . 'JOIN `artworks` AS `a` ON `rv`.`id_artworks` = `a`.`id`'
                . 'LEFT JOIN `reviewsTags` AS `rvt` ON `rvt`.`id_reviews` = `rv`.`id`'
                . 'LEFT JOIN `tags` AS `t` ON `t`.`id` = `rvt`.`id_tags`'
                . 'LEFT JOIN ('
                    . 'SELECT '
                        . '`up`.`id_reviews` AS `upid_reviews`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                        . 'COUNT(`up`.`upvote`) AS `upvoteCount`,'
                        . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) AS `upCount`,'
                        . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, (ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) - COUNT(IF(`up`.`upvote` = 1, 1, NULL)))), 1000) AS `upvoteStdDev`'
                    . 'FROM `reviews` AS `rv`'
                        . 'LEFT JOIN `upvotes` AS `up` ON `up`.`id_reviews` = `rv`.`id`'
                        . 'GROUP BY `rv`.`id`'
                    . ') `up` ON `up`.`upid_reviews` = `rv`.`id`'
                . 'LEFT JOIN ('
                    . 'SELECT '
                        . '`upv`.`id_reviews` AS `upid_reviews`,'
                        . 'IF(`upv`.`id_users` = :id_users AND `upv`.`upvote` = 1, 1, 0) AS `classupvote`'
                    . 'FROM `upvotes` AS `upv`'
                    . 'WHERE id_users = :id_users'
                . ') `upv` ON `upv`.`upid_reviews` = `rv`.`id`'
                . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artworks` = `rv`.`id_artworks`'
                . 'LEFT JOIN `comments` AS `com` ON `com`.`id_reviews` = `rv`.`id`'
                . 'LEFT JOIN `AA` ON `AA`.`id_artworks` = `a`.`id`'
                . 'LEFT JOIN `artists` AS `ats` ON `ats`.`id` = `AA`.`id_artworks`'
                . 'WHERE `rv`.`title` LIKE :search OR `a`.`name` LIKE :search OR `ats`.`name` LIKE :search OR `t`.`tag` LIKE :search OR `us`.`pseudo` LIKE :search '
                . 'GROUP BY `rv`.`id` '
            . 'ORDER BY' .$order;
            $reviews = Database::getInstance()->prepare($query);
            $reviews->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
            $reviews->bindValue(':search', '%' .$this->search. '%', PDO::PARAM_STR);
        if($reviews->execute()){
            if (is_object($reviews)) {
                $result = $reviews->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * check if review id exist in reviews table
     * @return bool
     */
    public function checkIfReviewExist(){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'reviews` WHERE `id` = :id';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * get review with all additional contents
     * @return array
     */
    public function selectReview(){
        $review = [];
        $query ='SELECT'
                . '`rv`.`id`,'
                . '`rv`.`title`,'
                . '`rv`.`review`,'
                . '`us`.`id` AS `idUs`,'
                . '`us`.`pseudo`,'
                . '`a`.`id` AS `artworkID`,' 
                . '`a`.`name`,'
                . '`t`.`tag`,'
                . 'IF(DATEDIFF(NOW(), `rv`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`rv`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `rv`.`date`), \'j\')) AS `reviewPastTime`,'
                . 'COUNT(`com`.`id`) AS `comCount`,'
                . 'IF(AVG(`sc`.`score`) < 0, \'null\', TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
                . 'IF(`red` > 0, `red`, 0) AS `red`,'
                . 'IF(`blue` > 0, `blue`, 0) AS `blue`,'
                . 'IF(`upvoteCount` > 0, `upvoteCount`, 0) AS `upvoteCount`,'
                . 'IF(`upvoteTotal` != 0, `upvoteTotal`, 0) AS `upvoteTotal`,'
                . 'IF(`upCount` > 0, `upCount`, 0) AS `upCount`,'
                . 'IF(`upvoteStdDev` > 0, `upvoteStdDev`, 0) AS `upvoteStdDev`'
            . 'FROM `reviews` AS `rv`'
                . 'JOIN `users` AS `us` ON `rv`.`id_users` = `us`.`id`'
                . 'JOIN `artworks` AS `a` ON `rv`.`id_artworks` = `a`.`id`'
                . 'LEFT JOIN `reviewsTags` AS `rvt` ON `rvt`.`id_reviews` = `rv`.`id`'
                . 'LEFT JOIN `tags` AS `t` ON `t`.`id` = `rvt`.`id_tags`'
                . 'LEFT JOIN ('
                    . 'SELECT'
                        . '`up`.`id_reviews` AS `upid_reviews`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                        . 'COUNT(`up`.`upvote`) AS `upvoteCount`,'
                        . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) AS `upCount`,'
                        . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, (ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) - COUNT(IF(`up`.`upvote` = 1, 1, NULL)))), 1000) AS `upvoteStdDev`'
                    . 'FROM `reviews` AS `rv`'
                        . 'LEFT JOIN `upvotes` AS `up` ON `up`.`id_reviews` = `rv`.`id`'
                        . 'GROUP BY `rv`.`id`'
                    . ') `up` ON `up`.`upid_reviews` = `rv`.`id`'
                . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artworks` = `rv`.`id_artworks`'
                . 'LEFT JOIN `comments` AS `com` ON `com`.`id_reviews` = `rv`.`id`'
                . 'WHERE `rv`.`id` = :id';
        $review = Database::getInstance()->prepare($query);
        $review->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($review->execute()){
            if (is_object($review)) {
                $result = $review->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;

    }

    /**
     * get review with all additional contents
     * + user concern
     * @return array
     */
    public function selectReviewUserConnected(){
        $review = [];
        $query = 'SELECT'
                . '`rv`.`id`,'
                . '`rv`.`title`,'
                . '`rv`.`review`,'
                . '`us`.`id` AS `idUs`,'
                . '`us`.`pseudo`,'
                . '`a`.`id` AS `artworkID`,'
                . '`a`.`name`,'
                . '`t`.`tag`,'
                . 'IF(DATEDIFF(NOW(), `rv`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`rv`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `rv`.`date`), \'j\')) AS `reviewPastTime`,'
                . 'COUNT(`com`.`id`) AS `comCount`,'
                . 'IF(AVG(`sc`.`score`) < 0, \'null\', TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
                . 'IF(`red` > 0, `red`, 0) AS `red`,'
                . 'IF(`blue` > 0, `blue`, 0) AS `blue`,'
                . 'IF(`upvoteCount` > 0, `upvoteCount`, 0) AS `upvoteCount`,'
                . 'IF(`upvoteTotal` != 0, `upvoteTotal`, 0) AS `upvoteTotal`,'
                . 'IF(`upCount` > 0, `upCount`, 0) AS `upCount`,'
                . 'IF(`upvoteStdDev` > 0, `upvoteStdDev`, 0) AS `upvoteStdDev`,'
                . '`classupvote`'
            . 'FROM `reviews` AS `rv`'
                . 'JOIN `users` AS `us` ON `rv`.`id_users` = `us`.`id`'
                . 'JOIN `artworks` AS `a` ON `rv`.`id_artworks` = `a`.`id`'
                . 'LEFT JOIN `reviewsTags` AS `rvt` ON `rvt`.`id_reviews` = `rv`.`id`'
                . 'LEFT JOIN `tags` AS `t` ON `t`.`id` = `rvt`.`id_tags`'
                . 'LEFT JOIN ('
                    . 'SELECT'
                        . '`up`.`id_reviews` AS `upid_reviews`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                        . 'COUNT(`up`.`upvote`) AS `upvoteCount`,'
                        . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) AS `upCount`,'
                        . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                        . 'IF(COUNT(`up`.`upvote`) > 0, (ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) - COUNT(IF(`up`.`upvote` = 1, 1, NULL)))), 1000) AS `upvoteStdDev`'
                    . 'FROM `reviews` AS `rv`'
                        . 'LEFT JOIN `upvotes` AS `up` ON `up`.`id_reviews` = `rv`.`id`'
                        . 'GROUP BY `rv`.`id`'
                    . ') `up` ON `up`.`upid_reviews` = `rv`.`id`'
                . 'LEFT JOIN ('
                    . 'SELECT'
                        . '`upv`.`id_reviews` AS `upid_reviews`,'
                        . '`upv`.`upvote` AS `classupvote`'
                    . 'FROM `upvotes` AS `upv`'
                    . 'WHERE id_users = :id_users'
                . ') `upv` ON `upv`.`upid_reviews` = `rv`.`id`'
                . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artworks` = `rv`.`id_artworks`'
                . 'LEFT JOIN `comments` AS `com` ON `com`.`id_reviews` = `rv`.`id`'
                . 'WHERE `rv`.`id` = :id';
            $review = Database::getInstance()->prepare($query);
            $review->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
            $review->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($review->execute()){
            if (is_object($review)) {
                $result = $review->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * get the last 5 reviews post for an user
     * @return array
     */
    public function selectLastUserReviews(){
        $reviews = [];
        $query = 'SELECT '
                    .' `rv`.`id`,'
                    .' `rv`.`title`,'
                    .' IF(DATEDIFF(NOW(), `rv`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`rv`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `rv`.`date`), \'j\')) AS `reviewPastTime`'
                .' FROM'
                    .' `reviews` `rv`'
                        .' LEFT JOIN '
                    .' `users` `us` ON `us`.`id` = `rv`.`id_users`'
                .' WHERE'
                    .' `us`.`pseudo` = :pseudo '
                    .' ORDER BY `rv`.`date` DESC LIMIT 5';
            $reviews = Database::getInstance()->prepare($query);
            $reviews->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if($reviews->execute()){
            if (is_object($reviews)) {
                $result = $reviews->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}