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

    /**
     * get all artworks
     * @return array
     */
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

    /**
     * insert an artwork in artworks table
     * @return bool
     */
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

    /**
     * check if an id exist in artworks table
     * @return bool
     */
    public function checkIfArtworkExist(){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'artworks` WHERE `id` = :id';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * get an artwork in artworks table with all contents in others tables
     * @return array
     */
    public function selectArtwork(){
        $artwork = [];
        $query = 'SELECT'
        . '`atk`.`id`,'
        . '`atk`.`name`,'
        . 'IF(`atk`.`releaseDate` = \'0000-00-00\', \'Non renseigné\', DATE_FORMAT(`atk`.`releaseDate`, \'%d/%m/%Y\')) AS `releaseDate`,'
        . '`atk`.`synopsis`, '
        . '`atk`.`budget`,'
        . '`d`.`distributor`,'
        . '`at`.`articleType`,'
        . 'GROUP_CONCAT(DISTINCT `N`.`nationality` SEPARATOR \', \') AS `nationalities`,'
        . 'GROUP_CONCAT(DISTINCT `C`.`country` SEPARATOR \', \') AS `countries`,'
        . 'GROUP_CONCAT(DISTINCT `p`.`plateform` SEPARATOR \', \') AS `plateforms`,'
        . 'GROUP_CONCAT(DISTINCT `g`.`genre` SEPARATOR \', \') AS `genres`,'
        . 'GROUP_CONCAT(DISTINCT `t`.`trailer` SEPARATOR \', \') AS `trailers`,'
        . 'IF(AVG(`sc`.`score`) < 0, null, TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
        . 'IF(AVG(`sc`.`score`) < 0, null, TRUNCATE(AVG(`sc`.`score`), 0)) AS `countStars`'
    . 'FROM `artworks` AS `atk`'
        . 'LEFT JOIN `distributors` AS `d` ON `d`.`id` = `atk`.`id_distributors`'
        . 'LEFT JOIN `articleTypes` AS `at` ON `at`.`id` = `atk`.`id_articleTypes`'
        . 'LEFT JOIN `AANationalities` AS `AAN` ON `AAN`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `Nationalities` AS `N` ON `N`.`id` = `AAN`.`id_nationalities`'
        . 'LEFT JOIN `AACountries` AS `AAC` ON `AAC`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `Countries` AS `C` ON `C`.`id` = `AAC`.`id_countries`'
        . 'LEFT JOIN `artworksPlateforms` AS `AP` ON `AP`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `plateforms` AS `p` ON `p`.`id` = `AP`.`id_PLATEFORMS`'
        . 'LEFT JOIN `artworksGenres` AS `AG` ON `AG`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `genres` AS `g` ON `g`.`id` = `AG`.`id_genres`'
        . 'LEFT JOIN `trailers` AS `t` ON `t`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artworks` = `atk`.`id`'
    . 'WHERE `atk`.`id` = :id';
        $artwork = Database::getInstance()->prepare($query);
        $artwork->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($artwork->execute()){
            if (is_object($artwork)) {
                $result = $artwork->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * get an artwork in artworks table with all contents in others tables
     * + user concern
     * @return array
     */
    public function selectArtworkUserConnected(){
        $artwork = [];
        $query = 'SELECT'
        . '`atk`.`id`,'
        . '`atk`.`name`,'
        . 'IF(`atk`.`releaseDate` = \'0000-00-00\', \'Non renseigné\', DATE_FORMAT(`atk`.`releaseDate`, \'%d/%m/%Y\')) AS `releaseDate`,'
        . '`atk`.`synopsis`, '
        . '`atk`.`budget`,'
        . 'GROUP_CONCAT(DISTINCT `d`.`distributor` SEPARATOR \', \') AS `distributor`,'
        . '`at`.`articleType`,'
        . 'GROUP_CONCAT(DISTINCT `N`.`nationality` SEPARATOR \', \') AS `nationalities`,'
        . 'GROUP_CONCAT(DISTINCT `C`.`country` SEPARATOR \', \') AS `countries`,'
        . 'GROUP_CONCAT(DISTINCT `p`.`plateform` SEPARATOR \', \') AS `plateforms`,'
        . 'GROUP_CONCAT(DISTINCT `g`.`genre` SEPARATOR \', \') AS `genres`,'
        . 'GROUP_CONCAT(DISTINCT `t`.`trailer` SEPARATOR \', \') AS `trailers`,'
        . 'IF(AVG(`sc`.`score`) < 0, null, TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
        . 'IF(AVG(`sc`.`score`) < 0, null, TRUNCATE(AVG(`sc`.`score`), 0)) AS `countStars`,'
        . '(SELECT `score` FROM `scores` WHERE `id_artworks` = :id AND `id_users` = :id_users) AS `ussc`'
    . 'FROM `artworks` AS `atk`'
        . 'LEFT JOIN `distributors` AS `d` ON `d`.`id` = `atk`.`id_distributors`'
        . 'LEFT JOIN `articleTypes` AS `at` ON `at`.`id` = `atk`.`id_articleTypes`'
        . 'LEFT JOIN `AANationalities` AS `AAN` ON `AAN`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `Nationalities` AS `N` ON `N`.`id` = `AAN`.`id_nationalities`'
        . 'LEFT JOIN `AACountries` AS `AAC` ON `AAC`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `Countries` AS `C` ON `C`.`id` = `AAC`.`id_countries`'
        . 'LEFT JOIN `artworksPlateforms` AS `AP` ON `AP`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `plateforms` AS `p` ON `p`.`id` = `AP`.`id_PLATEFORMS`'
        . 'LEFT JOIN `artworksGenres` AS `AG` ON `AG`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `genres` AS `g` ON `g`.`id` = `AG`.`id_genres`'
        . 'LEFT JOIN `trailers` AS `t` ON `t`.`id_artworks` = `atk`.`id`'
        . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artworks` = `atk`.`id`'
    . 'WHERE `atk`.`id` = :id';
        $artwork = Database::getInstance()->prepare($query);
        $artwork->bindValue(':id', $this->id, PDO::PARAM_INT);
        $artwork->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if($artwork->execute()){
            if (is_object($artwork)) {
                $result = $artwork->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

}
