<?php

class Columns extends Database {

    public function __constructor() {
        parent::__construct();
    }

    public function showColumns($table) {
        $column = [];
        $query = 'SHOW COLUMNS FROM  `' .SALT.$table. '`';
        $column = $this->db->prepare($query);
        if($column->execute()){
            if (is_object($column)) {
                $result = $column->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
    
}
