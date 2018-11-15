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

    public function insertArtworkCountries(){
        $query = 'INSERT INTO `' .SALT. 'AACountries`'
        . '(`id_artworks`, `id_countries`)'
        . 'VALUES'
        . '(:id_artworks, :id_countries)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':id_artworks', $this->artworkID, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_countries', $this->country, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
}