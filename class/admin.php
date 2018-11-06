<?php

class Admin extends Database {

    public function __constructor() {
        parent::__construct();
    }
    public function showTables(){
        $column = [];
        $query = 'SHOW TABLES';
        $column = $this->db->prepare($query);
        if($column->execute()){
            if (is_object($column)) {
                $result = $column->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
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

    public function getAllInTable($table) {
        $all = [];
        $query = 'SELECT * FROM  `' .SALT.$table. '`';
        $all = $this->db->prepare($query);
        if($all->execute()){
            if (is_object($all)) {
                $result = $all->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
    
    public function deleteInTable($table) {
        $delete = [];
        $query = 'DELETE FROM  `' .SALT.$table. '` WHERE `id` = :id';
        $delete = $this->db->prepare($query);
        $delete->bindValue(':id', $this->id, PDO::PARAM_STR);
        return $delete->execute();
    }
}
