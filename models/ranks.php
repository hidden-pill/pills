<?php

class Ranks extends Database {

    public $id = null;

    public function __constructor() {
        parent::__construct();
    }

    public function ranksSelect() {
        $rank = [];
        $query = 'SELECT `id`, `rank` FROM `ranks`';
        $rank = $this->db->query($query);
        if($rank->execute()){
            if (is_object($rank)) {
                $result = $rank->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

}