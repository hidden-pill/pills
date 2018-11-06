<?php

class Artists extends Database {

    public $id = null;
    public $name = null;
    public $birthDate = null;
    public $deathDate = null;
    public $biography = null;
    public $image = null;

    public function __constructor() {
        parent::__construct();
    }

    public function selectArtists() {
        $artist = [];
        $query = 'SELECT `id`, `name`, `birthDate`, `deathDate`, `biography`, `image` FROM `' .SALT. 'artists`';
        $artist = $this->db->query($query);
        if($artist->execute()){
            if (is_object($artist)) {
                $result = $artist->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}