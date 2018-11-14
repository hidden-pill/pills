<?php

class Artists extends Database {

    public $id = null;
    public $name = null;
    public $birthDate = null;
    public $deathDate = null;
    public $biography = null;
    public $image = null;
    public $id_validations = null;

    public function __constructor() {
        parent::__construct();
    }

    public function selectArtists() {
        $artist = [];
        $query = 'SELECT `id`, `name`, `birthDate`, `deathDate`, `biography`, `image`, `id_validations` FROM `' .SALT. 'artists`';
        $artist = Database::getInstance()->query($query);
        if($artist->execute()){
            if (is_object($artist)) {
                $result = $artist->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}