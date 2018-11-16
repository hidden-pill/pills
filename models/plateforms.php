<?php

class Plateforms extends Database {

    public $id = null;
    public $plateform = null;


        
    public function selectPlateforms() {
        $plateform = [];
        $query = 'SELECT `id`, `plateform` FROM `' .SALT. 'plateforms`';
        $plateform = Database::getInstance()->query($query);
        if($plateform->execute()){
            if (is_object($plateform)) {
                $result = $plateform->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function insertArtworkPlateform(){
        $query = 'INSERT INTO `' .SALT. 'plateforms`'
        . '(`plateform`)'
        . 'VALUES'
        . '(:plateform)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':plateform', $this->plateform, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
}