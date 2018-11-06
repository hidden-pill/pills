<?php

class Rewards extends Database {

    public $id = null;
    public $reward = null;

    public function __constructor() {
        parent::__construct();
    }

    public function selectRewards() {
        $reward = [];
        $query = 'SELECT `id`, `reward` FROM `' .SALT. 'rewards`';
        $reward = $this->db->query($query);
        if($reward->execute()){
            if (is_object($reward)) {
                $result = $reward->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  
}