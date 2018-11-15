<?php

class Plateforms extends Database {

    public $id = null;
    public $website = null;


        
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
}