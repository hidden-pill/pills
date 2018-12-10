<?php

class AA extends Database {

    public $id = null;
    public $id_artists = null;
    public $id_artworks = null;

    /**
     * insert an artist and an artwork with thier id
     * @return bool
     */
    public function insertArtistArtwork(){
        $query = 'INSERT INTO `' .SALT. 'AA`'
        . '(`id_artists`, `id_artworks`)'
        . 'VALUES'
        . '(:id_artists, :id_artworks)';
        $artistCountry = Database::getInstance()->prepare($query);
        $artistCountry->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        $artistCountry->bindValue(':id_artworks', $this->artworkID, PDO::PARAM_INT);
        return $artistCountry->execute();
    }
    
    /**
     * get a list of artists for artwork request
     * @return array
     */
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

    /**
     * get a list of artworks for artist request
     * @return array
     */
    public function selectArtistArtworks(){
        $artworks = [];
        $query = 'SELECT '
                    . '`atk`.`id`,'
                    . '`atk`.`name`,'
                    . '`at`.`articleType`'
                . 'FROM `AA`'
                    . 'LEFT JOIN `artworks` `atk` ON `atk`.`id` = `AA`.`id_artworks`'
                    . 'LEFT JOIN `articleTypes` `at` ON `at`.`id` = `atk`.`id_articleTypes`'
                . 'WHERE `AA`.`id_artists` = :id_artists '
                . 'GROUP BY `atk`.`id`';
        $artworks = Database::getInstance()->prepare($query);
        $artworks->bindValue(':id_artists', $this->id_artists, PDO::PARAM_INT);
        if($artworks->execute()){
            if (is_object($artworks)) {
                $result = $artworks->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}