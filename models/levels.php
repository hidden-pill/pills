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
}