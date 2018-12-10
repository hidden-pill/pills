<?php

class AANationalities extends Database {

    public $id = null;
    public $id_nationalities = null;
    public $id_artists = null;

    /**
     * insert artist and nationality ids into table AANationalities
     * @return bool
     */
    public function insertArtistNationalities(){
        $query = 'INSERT INTO `' .SALT. 'AANationalities`'
        . '(`id_artists`, `id_nationalities`)'
        . 'VALUES'
        . '(:id_artists, :id_nationalities)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        $artistJob->bindValue(':id_nationalities', $this->nationality, PDO::PARAM_INT);
        return $artistJob->execute();
    }

    /**
     * insert artwork and nationality ids into table AANationalities
     * @return bool
     */
    public function insertArtworkNationalities(){
        $query = 'INSERT INTO `' .SALT. 'AANationalities`'
        . '(`id_artworks`, `id_nationalities`)'
        . 'VALUES'
        . '(:id_artworks, :id_nationalities)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':id_artworks', $this->artworkID, PDO::PARAM_INT);
        $artistJob->bindValue(':id_nationalities', $this->nationality, PDO::PARAM_INT);
        return $artistJob->execute();
    }
}
