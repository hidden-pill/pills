<?php

class ACO extends Database {

    public $id = null;
    public $id_artists = null;
    public $id_culturalObjects = null;

    public function insertArtistCO(){
        $query = 'INSERT INTO `' .SALT. 'ACO`'
        . '(`id_artists`, `id_culturalObjects`)'
        . 'VALUES'
        . '(:id_artists, :id_culturalObjects)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_culturalObjects', $this->co, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
}