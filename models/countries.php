<?php

class Countries extends Database {

    public $id = null;
    public $country = null;

    /**
    * get all countries 
    * @return array 
    */
    public function selectCountries() {
        $country = [];
        $query = 'SELECT `id`, `country` FROM `' .SALT. 'countries`';
        $country = Database::getInstance()->query($query);
        if($country->execute()){
            if (is_object($country)) {
                $result = $country->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}