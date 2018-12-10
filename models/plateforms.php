<?php

class Plateforms extends Database {

    public $id = null;
    public $plateform = null;


    /**
     * get all plateform in plateforms table
     * @return array
     */
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

    /**
     * insert plateform in plateforms
     * @return array
     */
    public function insertArtworkPlateform(){
        $query = 'INSERT INTO `' .SALT. 'plateforms`'
        . '(`plateform`)'
        . 'VALUES'
        . '(:plateform)';
        $plateform = Database::getInstance()->prepare($query);
        $plateform->bindValue(':plateform', $this->plateform, PDO::PARAM_INT);
        return $plateform->execute();
    }
}