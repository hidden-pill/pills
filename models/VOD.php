<?php

class VOD extends Database {

    public $id = null;
    public $website = null;


        
    public function selectVOD() {
        $website = [];
        $query = 'SELECT `id`, `website` FROM `' .SALT. 'VOD`';
        $website = Database::getInstance()->query($query);
        if($website->execute()){
            if (is_object($website)) {
                $result = $website->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}