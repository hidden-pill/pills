<?php

class Ranks extends Database {

    public $id = null;
    public $rank = null;



    public function selectRanks() {
        $rank = [];
        $query = 'SELECT `id`, `rank` FROM `' .SALT. 'ranks`';
        $rank = Database::getInstance()->query($query);
        if($rank->execute()){
            if (is_object($rank)) {
                $result = $rank->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

}