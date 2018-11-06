<?php

class Levels extends Database {

    public $id = null;

    public function __constructor() {
        parent::__construct();
    }
    
    public function selectLevels() {
        $level = [];
        $query = 'SELECT `id`, `level` FROM `levels`';
        $level = $this->db->query($query);
        if($level->execute()){
            if (is_object($level)) {
                $result = $level->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}