<?php

class ArtworksGenres extends Database {

    public $id = null;

    public function insertArtworkGenre(){
        $query = 'INSERT INTO `' .SALT. 'artworksGenres`'
        . '(`id_artworks`, `id_genres`)'
        . 'VALUES'
        . '(:id_artworks, :id_genres)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':id_artworks', $this->artworkID, PDO::PARAM_INT);
        $artistJob->bindValue(':id_genres', $this->artworkGenre, PDO::PARAM_INT);
        return $artistJob->execute();
    }
}