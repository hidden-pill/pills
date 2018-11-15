<?php

class AANationalities extends Database {

    public $id = null;
    public $id_nationalities = null;
    public $id_artists = null;

    public function insertArtistNationalities(){
        $query = 'INSERT INTO `' .SALT. 'ACONationalities`'
        . '(`id_artists`, `id_nationalities`)'
        . 'VALUES'
        . '(:id_artists, :id_nationalities)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        $artistJob->bindValue(':id_nationalities', $this->nationality, PDO::PARAM_INT);
        return $artistJob->execute();
    }

}