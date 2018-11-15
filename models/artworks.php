<?php

class Artworks extends Database {

    public $id = null;
    public $name = null;
    public $releaseDate = null;
    public $synopsis = null;
    public $image = null;
    public $budget = null;
    public $id_articleTypes	= null;
    public $id_validations = null; 


    public function selectArtworks() {
        $culturalObject = [];
        $query = 'SELECT `id`, `name`, `releaseDate`, `synopsis`, `budget`, `id_articleTypes`, `id_distributors`, `validation` FROM `' .SALT. 'artworks`';
        $culturalObject = Database::getInstance()->query($query);
        if($culturalObject->execute()){
            if (is_object($culturalObject)) {
                $result = $culturalObject->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function insertArtwork(){
        $query = 'INSERT INTO `' .SALT. 'artworks`'
        . '(`name`, `releaseDate`, `synopsis`, `budget`, `id_articleTypes`, `id_distributors`)'
        . 'VALUES'
        . '(:name, :releaseDate, :synopsis, :budget, :id_articleTypes, :id_distributors)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':name', $this->name, PDO::PARAM_STR);
        $artistCountry->bindValue(':releaseDate', $this->releaseDate, PDO::PARAM_STR);
        $artistCountry->bindValue(':synopsis', $this->synopsis, PDO::PARAM_STR);
        $artistCountry->bindValue(':budget', $this->budget, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_articleTypes', $this->id_articleTypes, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_distributors', $this->id_distributors, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
}