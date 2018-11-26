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

    public function selectArtworkArtists(){
        $artists = [];
        $query = 'SELECT '
            . '`ats`.`id`,'
            . '`ats`.`name`,'
            . 'GROUP_CONCAT(`j`.`job` SEPARATOR \', \') `jobs`'
        . 'FROM `AA`'
            . 'LEFT JOIN `artists` `ats` ON `ats`.`id` = `AA`.`id_artists`'
            . 'LEFT JOIN `artistsJobs` `ajob` ON `ajob`.`id_artists` = `ats`.`id`'
            . 'LEFT JOIN `jobs` `j` ON `j`.`id` = `ajob`.`id_jobs`'
        . 'WHERE `AA`.`id_artworks` = :id_artworks '
        . 'GROUP BY `ats`.`id`';
        $artists = Database::getInstance()->prepare($query);
        $artists->bindValue(':id_artworks', $this->id_artworks, PDO::PARAM_INT);
        if($artists->execute()){
            if (is_object($artists)) {
                $result = $artists->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
        }
}