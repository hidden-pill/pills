<?php

class Artworks extends Database {

    public $id = null;
    public $name = null;
    public $releaseDate = null;
    public $synopsis = null;
    public $image = null;
    public $budget = null;
    public $id_articleTypes	= null;
    public $id_validations = null;


    public function selectArtworks() {
        $culturalObject = [];
        $query = 'SELECT `id`, `name`, `releaseDate`, `synopsis`, `budget`, `id_articleTypes`, `validation` FROM `' .SALT. 'artworks`';
        $culturalObject = Database::getInstance()->query($query);
        if($culturalObject->execute()){
            if (is_object($culturalObject)) {
                $result = $culturalObject->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}