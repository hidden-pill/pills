<?php

class Distributors extends Database {

    public $id = null;
    public $distributor = null;


    /**
    * get all distributors 
    * @return array 
    */    
    public function selectDistributors() {
        $distributor = [];
        $query = 'SELECT `id`, `distributor` FROM `' .SALT. 'distributors`';
        $distributor = Database::getInstance()->query($query);
        if($distributor->execute()){
            if (is_object($distributor)) {
                $result = $distributor->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  

    /**
     * insert distributor in distributors table
     * @return array
     */
    public function insertDistributor(){
        $query = 'INSERT INTO `' .SALT. 'distributors`'
        . '(`distributor`)'
        . 'VALUES'
        . '(:distributor)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':distributor', $this->distributor, PDO::PARAM_STR);
        return $artistCountry->execute();
    }
}