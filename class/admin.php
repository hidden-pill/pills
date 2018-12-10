<?php

class Admin extends Database {

    /**
     * method to get all tables in db
     * @return array
     */
    public function showTables(){
        $column = [];
        $query = 'SHOW TABLES';
        $column = Database::getInstance()->prepare($query);
        if($column->execute()){
            if (is_object($column)) {
                $result = $column->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * method to get all columns of a table
     * @param table $table the table wanted
     * @return array
     */
    public function showColumns($table) {
        $column = [];
        $query = 'SHOW COLUMNS FROM  `' .SALT.$table. '`';
        $column = Database::getInstance()->prepare($query);
        if($column->execute()){
            if (is_object($column)) {
                $result = $column->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * method to get all content of a table
     * @param table $table the table wanted
     * @return array
     */
    public function getAllInTable($table) {
        $all = [];
        $query = 'SELECT * FROM  `' .SALT.$table. '`';
        $all = Database::getInstance()->prepare($query);
        if($all->execute()){
            if (is_object($all)) {
                $result = $all->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
    /**
     * method to delete an element of a table
     * @return bool
     */
    public function deleteInTable($table) {
        $delete = [];
        $query = 'DELETE FROM  `' .SALT.$table. '` WHERE `id` = :id';
        $delete = Database::getInstance()->prepare($query);
        $delete->bindValue(':id', $this->id, PDO::PARAM_STR);
        return $delete->execute();
    }
}
