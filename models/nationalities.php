<?php

class Nationalities extends Database {

    public $id = null;
    public $nationality = null;

    /**
     * get all nationality in nationalities table
     * @return array
     */
    public function selectNationalities() {
        $nationality = [];
        $query = 'SELECT `id`, `nationality` FROM `' .SALT. 'nationalities`';
        $nationality = Database::getInstance()->query($query);
        if($nationality->execute()){
            if (is_object($nationality)) {
                $result = $nationality->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}