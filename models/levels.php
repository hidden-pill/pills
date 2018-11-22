<?php

class Levels extends Database {

    public $id = null;
    public $level = null;
    public $color = null;
    public $reachXp = null;



    public function selectLevels() {
        $level = [];
        $query = 'SELECT `id`, `level` FROM `levels`';
        $level = Database::getInstance()->query($query);
        if($level->execute()){
            if (is_object($level)) {
                $result = $level->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function searchLevel() {
        $level = [];
        $query = 'SELECT `level`, `color` FROM `levels` WHERE levelxp <= :experience ORDER BY `level` DESC LIMIT 1';
        $level = Database::getInstance()->prepare($query);
        $level->bindValue(':experience', $this->experience, PDO::PARAM_INT);
        if($level->execute()){
            if (is_object($level)) {
                $result = $level->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function leaderboard() {
        $leaderboard = [];
        $query = 'SELECT'
                    . '`lvlus`.`pseudo`,'
                    . '`lvlus`.`level`,'
                    . '`lvlus`.`experience`,'
                    . '`levels`.`color`'
                . 'FROM'
                    . '`levels`'
                        . 'LEFT JOIN'
                    . '(SELECT '
                        . '`us`.`pseudo`, MAX(`lvl`.`level`) AS `level`, `us`.`experience`, `us`.`creationDate` '
                    . 'FROM'
                        . '`users` AS `us`, `levels` AS `lvl`'
                    . 'WHERE'
                        . '`us`.`experience` - `lvl`.`levelxp` >= 0 '
                    . 'GROUP BY `us`.`pseudo`) AS `lvlus` ON `lvlus`.`level` = `levels`.`level` '
                    . 'ORDER BY `lvlus`.`experience` DESC, `lvlus`.`creationDate` DESC '
                    . 'LIMIT :page, :limit';
        $leaderboard = Database::getInstance()->prepare($query);
        $leaderboard->bindValue(':page', $this->page, PDO::PARAM_INT);
        $leaderboard->bindValue(':limit', $this->limit, PDO::PARAM_INT);
        if($leaderboard->execute()){
            if (is_object($leaderboard)) {
                $result = $leaderboard->fetchALL(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

}