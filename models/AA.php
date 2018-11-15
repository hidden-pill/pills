<?php

class AA extends Database {

    public $id = null;
    public $id_artists = null;
    public $id_artworks = null;

    public function insertArtistArtwork(){
        $query = 'INSERT INTO `' .SALT. 'AA`'
        . '(`id_artists`, `id_artworks`)'
        . 'VALUES'
        . '(:id_artists, :id_artworks)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_artworks', $this->artwork, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
}