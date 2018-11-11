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
                    . '`us`.`id` AS `idUs`,'
                    . '`us`.`pseudo`,'
                    . '`us`.`image` AS `imageUs`,'
                    . '`co`.`name`,'
                    . '`co`.`image`,'
                    . '`t`.`tag`,'
                    . '	IF(DATEDIFF(NOW(), `rv`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`rv`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `rv`.`date`), \'j\')) AS `reviewPastTime`,'
                    . 'COUNT(`com`.`id`) AS `comCount`,'
                    . '`scoreAVG`,'
                    . 'IF(`red` > 0, `red`, 0) AS `red`,'
                    . 'IF(`blue` > 0, `blue`, 0) AS `blue`,'
                    . 'IF(`upvoteCount` > 0, `upvoteCount`, 0) AS `upvoteCount`,'
                    . 'IF(`upCount` > 0, `upCount`, 0) AS `upCount`,'
                    . 'IF(`downCount` > 0, `downCount`, 0) AS `downCount`,'
                    . 'IF(`upvoteStdDev` > 0, `upvoteStdDev`, 0) AS `upvoteStdDev`'
                . 'FROM `reviews` AS `rv`'
                    . 'JOIN `users` AS `us` ON `rv`.`id_users` = `us`.`id`'
                    . 'JOIN `culturalobjects` AS `co` ON `rv`.`id_culturalobjects` = `co`.`id`'
                    . 'LEFT JOIN `reviewsTags` AS `rvt` ON `rvt`.`id_reviews` = `rv`.`id`'
                    . 'LEFT JOIN `tags` AS `t` ON `t`.`id` = `rvt`.`id_tags`'
                    . 'LEFT JOIN ('
                        . 'SELECT'
                            . '`up`.`id_reviews` AS `upid_reviews`,'
                            . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                            . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                            . 'COUNT(`up`.`upvote`) AS `upvoteCount`,'
                            . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) AS `upCount`, '
                            . 'COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `downCount`,'
                            . 'IF(COUNT(`up`.`upvote`) > 0, (ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) - COUNT(IF(`up`.`upvote` = 1, 1, NULL)))), 1000) AS `upvoteStdDev`'
                        . 'FROM `reviews` AS `rv`'
                            . 'LEFT JOIN `upvotes` AS `up` ON `up`.`id_reviews` = `rv`.`id`'
                            . 'GROUP BY `rv`.`id`'
                        . ') `up` ON `up`.`upid_reviews` = `rv`.`id`'
                    . 'LEFT JOIN ('
                        . 'SELECT'
                            . '`sc`.`id_culturalObjects` AS `scid_culturalObjects`,'
                            . 'TRUNCATE(AVG(`sc`.`score`), 2) AS `scoreAVG`'
                        . 'FROM `reviews` AS `rv`'
                            . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_culturalObjects` = `rv`.`id`'
                            . 'GROUP BY `rv`.`id`'
                        . ') `sc` ON `sc`.`scid_culturalObjects` = `rv`.`id_culturalObjects`'
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