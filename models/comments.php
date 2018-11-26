<?php

class Comments extends Database {

    public $id = null;
    public $comment = null;
    public $date = null;
    public $commentsId = null;
    public $id_reviews = null;
    public $id_proposals = null;
    public $id_artists = null;
    public $id_users = null;

    public function selectReviewCommentsUserConnected(){
        $comments = [];
        $query = 'SELECT'
                    . '`com`.`id`,'
                    . '`com`.`commentsId`,'
                    . '`us`.`id` AS `userID`,'
                    . '`us`.`pseudo`,'
                    . '`com`.`comment`,'
                    . 'IF(DATEDIFF(NOW(), `com`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`com`.`date`, \'%T\')), \' heure(s)\'), CONCAT(DATEDIFF(NOW(), `com`.`date`), \' jour(s)\')) AS `comPastTime`,'
                    . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                    . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                    . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                    . '`upv`.`usvote`,'
                    . 'CASE `com`.`commentsId` '
                    . 'WHEN 0 THEN CONCAT_WS(\'.\',`com`.`id`,LPAD((SELECT MAX(`id`)+1 FROM Comments WHERE `com`.`commentsId` = `com`.`id`), 2, 0)) '
                    . 'ELSE CONCAT_WS(\'.\',`com`.`commentsId`,LPAD(`com`.`id`,2,0)) '
                    . 'END AS `sort`'
                    . 'FROM'
                    . '`comments` AS `com`'
                        . 'LEFT JOIN'
                    . '`users` AS `us` ON `us`.`id` = `com`.`id_users`'
                        . 'LEFT JOIN'
                    . '`upvotes` AS `up` ON `up`.`id_comments` = `com`.`id`'
                        . 'LEFT JOIN'
                    . '	(SELECT `upvotes`.`id_comments` AS `idupc`, `upvotes`.`upvote` AS `usvote` FROM `upvotes` WHERE `id_users` = :id_users) AS `upv` ON `idupc` = `com`.`id`'
                . 'WHERE '
                    . 'com.id_reviews = :id_reviews '
                . 'GROUP BY `com`.`id` '
                . 'ORDER BY `sort` ASC';
            $comments = Database::getInstance()->prepare($query);
            $comments->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
            $comments->bindValue(':id_reviews', $this->id_reviews, PDO::PARAM_INT);
        if($comments->execute()){
            if (is_object($comments)) {
                $result = $comments->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function selectArtistCommentsUserConnected(){
        $comments = [];
        $query = 'SELECT'
                    . '`com`.`id`,'
                    . '`com`.`commentsId`,'
                    . '`us`.`id` AS `userID`,'
                    . '`us`.`pseudo`,'
                    . '`com`.`comment`,'
                    . 'IF(DATEDIFF(NOW(), `com`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`com`.`date`, \'%T\')), \' heure(s)\'), CONCAT(DATEDIFF(NOW(), `com`.`date`), \' jour(s)\')) AS `comPastTime`,'
                    . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                    . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                    . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                    . '`upv`.`usvote`,'
                    . 'CASE `com`.`commentsId` '
                    . 'WHEN 0 THEN CONCAT_WS(\'.\',`com`.`id`,LPAD((SELECT MAX(`id`)+1 FROM Comments WHERE `com`.`commentsId` = `com`.`id`), 2, 0)) '
                    . 'ELSE CONCAT_WS(\'.\',`com`.`commentsId`,LPAD(`com`.`id`,2,0)) '
                    . 'END AS `sort`'
                    . 'FROM'
                    . '`comments` AS `com`'
                        . 'LEFT JOIN'
                    . '`users` AS `us` ON `us`.`id` = `com`.`id_users`'
                        . 'LEFT JOIN'
                    . '`upvotes` AS `up` ON `up`.`id_comments` = `com`.`id`'
                        . 'LEFT JOIN'
                    . '	(SELECT `upvotes`.`id_comments` AS `idupc`, `upvotes`.`upvote` AS `usvote` FROM `upvotes` WHERE `id_users` = :id_users) AS `upv` ON `idupc` = `com`.`id`'
                . 'WHERE '
                    . 'com.id_artists = :id_artists '
                . 'GROUP BY `com`.`id` '
                . 'ORDER BY `sort` ASC';
            $comments = Database::getInstance()->prepare($query);
            $comments->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
            $comments->bindValue(':id_artists', $this->id_artists, PDO::PARAM_INT);
        if($comments->execute()){
            if (is_object($comments)) {
                $result = $comments->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function selectArtworkCommentsUserConnected(){
        $comments = [];
        $query = 'SELECT'
                    . '`com`.`id`,'
                    . '`com`.`commentsId`,'
                    . '`us`.`id` AS `userID`,'
                    . '`us`.`pseudo`,'
                    . '`com`.`comment`,'
                    . 'IF(DATEDIFF(NOW(), `com`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`com`.`date`, \'%T\')), \' heure(s)\'), CONCAT(DATEDIFF(NOW(), `com`.`date`), \' jour(s)\')) AS `comPastTime`,'
                    . 'COUNT(IF(`up`.`upvote` = 1, 1, NULL)) - COUNT(IF(`up`.`upvote` = 0, 1, NULL)) AS `upvoteTotal`,'
                    . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 1, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 1, 1, NULL)) > COUNT(IF(`up`.`upvote` = 0, 1, NULL)), +100, -100)) , 0) AS `red`,'
                    . 'IF(COUNT(`up`.`upvote`) > 0, ABS(COUNT(IF(`up`.`upvote` = 0, 1, NULL)))+(IF(COUNT(IF(`up`.`upvote` = 0, 1, NULL)) > COUNT(IF(`up`.`upvote` = 1, 1, NULL)), +100, -100)) , 0) AS `blue`,'
                    . '`upv`.`usvote`,'
                    . 'CASE `com`.`commentsId` '
                    . 'WHEN 0 THEN CONCAT_WS(\'.\',`com`.`id`,LPAD((SELECT MAX(`id`)+1 FROM Comments WHERE `com`.`commentsId` = `com`.`id`), 2, 0)) '
                    . 'ELSE CONCAT_WS(\'.\',`com`.`commentsId`,LPAD(`com`.`id`,2,0)) '
                    . 'END AS `sort`'
                    . 'FROM'
                    . '`comments` AS `com`'
                        . 'LEFT JOIN'
                    . '`users` AS `us` ON `us`.`id` = `com`.`id_users`'
                        . 'LEFT JOIN'
                    . '`upvotes` AS `up` ON `up`.`id_comments` = `com`.`id`'
                        . 'LEFT JOIN'
                    . '	(SELECT `upvotes`.`id_comments` AS `idupc`, `upvotes`.`upvote` AS `usvote` FROM `upvotes` WHERE `id_users` = :id_users) AS `upv` ON `idupc` = `com`.`id`'
                . 'WHERE '
                    . '`com`.`id_artworks` = :id_artworks '
                . 'GROUP BY `com`.`id` '
                . 'ORDER BY `sort` ASC';
            $comments = Database::getInstance()->prepare($query);
            $comments->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
            $comments->bindValue(':id_artworks', $this->id_artworks, PDO::PARAM_INT);
        if($comments->execute()){
            if (is_object($comments)) {
                $result = $comments->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function insertComment($column){
        $state = false;
        $query = 'INSERT INTO `' .SALT. 'comments` '
                    . '(`comment`, `' .$column. '`, `id_users`) '
                    . 'VALUES '
                    . '(:comment, :id_column, :id_users)';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id_column', $this->id_column, PDO::PARAM_INT);
        $result->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $result->bindValue(':comment', $this->comment, PDO::PARAM_STR);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function selectLastUserComments(){
        $comments = [];
        $query = 'SELECT '
                    . '`com`.`comment`,'
                    . 'IF(DATEDIFF(NOW(), `com`.`date`) = 0, CONCAT(ABS(DATE_FORMAT(NOW(), \'%T\') - DATE_FORMAT(`com`.`date`, \'%T\')), \'h\'), CONCAT(DATEDIFF(NOW(), `com`.`date`), \'j\')) AS `commentPastTime`'
                . 'FROM'
                    . '`comments` `com`'
                        . 'LEFT JOIN '
                    . '`users` `us` ON `us`.`id` = `com`.`id_users`'
                . 'WHERE'
                    . '`us`.`pseudo` = :pseudo '
                . 'ORDER BY `com`.`date` DESC LIMIT 5';
            $comments = Database::getInstance()->prepare($query);
            $comments->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if($comments->execute()){
            if (is_object($comments)) {
                $result = $comments->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}