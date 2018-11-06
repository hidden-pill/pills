<?php

class Countries extends Database {

    public $id = null;
    public $country = null

    public function __constructor() {
        parent::__construct();
    }

    public function selectCountries() {
        $country = [];
        $query = 'SELECT `id`, `country` FROM `' .SALT. 'countries`';
        $country = $this->db->query($query);
        if($country->execute()){
            if (is_object($country)) {
                $result = $country->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}