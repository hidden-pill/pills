<?php

class Rewards extends Database {

    public $id = null;
    public $reward = null;


    /**
     * get all reward in rewards table
     * @return array
     */
    public function selectRewards() {
        $reward = [];
        $query = 'SELECT `id`, `reward` FROM `' .SALT. 'rewards`';
        $reward = Database::getInstance()->query($query);
        if($reward->execute()){
            if (is_object($reward)) {
                $result = $reward->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  
}