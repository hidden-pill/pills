<?php

class Artists extends Database {

    public $id = null;
    public $name = null;
    public $birthDate = null;
    public $deathDate = null;
    public $biography = null;
    public $id_validations = null;

    public function selectArtists() {
        $artist = [];
        $query = 'SELECT `id`, `name`, `birthDate`, `deathDate`, `biography`, `validation` FROM `' .SALT. 'artists`';
        $artist = Database::getInstance()->query($query);
        if($artist->execute()){
            if (is_object($artist)) {
                $result = $artist->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function insertArtist(){
        $query = 'INSERT INTO `' .SALT. 'artists`'
        . '(`name`, `birthDate`, `deathDate`, `biography`)'
        . 'VALUES '
        . '(:name, :birthDate, :deathDate, :biography)';
        $artist = Database::getInstance()->prepare($query);
        $artist->bindValue(':name', $this->name, PDO::PARAM_STR);
        $artist->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $artist->bindValue(':deathDate', $this->deathDate, PDO::PARAM_STR);
        $artist->bindValue(':biography', $this->bio, PDO::PARAM_STR);
        return $artist->execute();
    }
}