<?php

class AACountries extends Database {

    public $id = null;
    public $id_countries = null;
    public $id_artists = null;


    public function insertArtistCountries(){
        $query = 'INSERT INTO `' .SALT. 'AACountries`'
        . '(`id_artists`, `id_countries`)'
        . 'VALUES'
        . '(:id_artists, :id_countries)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_countries', $this->country, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
}