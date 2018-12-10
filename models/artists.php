<?php

class Artists extends Database {

    public $id = null;
    public $name = null;
    public $birthDate = null;
    public $deathDate = null;
    public $biography = null;
    public $id_validations = null;

    /**
     * get all artists
     * @return array
     */
    public function selectArtists() {
        $artist = [];
        $query = 'SELECT `id`, `name`, `birthDate`, `deathDate`, `biography`, `validation` FROM `' .SALT. 'artists`';
        $artist = Database::getInstance()->query($query);
        if($artist->execute()){
            if (is_object($artist)) {
                $result = $artist->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * insert an artist in artists table
     * @return bool
     */
    public function insertArtist(){
        $query = 'INSERT INTO `' .SALT. 'artists`'
        . '(`name`, `birthDate`, `deathDate`, `biography`)'
        . 'VALUES '
        . '(:name, :birthDate, :deathDate, :biography)';
        $artist = Database::getInstance()->prepare($query);
        $artist->bindValue(':name', $this->name, PDO::PARAM_STR);
        $artist->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $artist->bindValue(':deathDate', $this->deathDate, PDO::PARAM_STR);
        $artist->bindValue(':biography', $this->bio, PDO::PARAM_STR);
        return $artist->execute();
    }

    /**
     * check if an id exist in artists table
     * @return bool
     */
    public function checkIfArtistExist(){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'artists` WHERE `id` = :id';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    /**
     * get an artist in artists table with all contents in others tables
     * @return array
     */
    public function selectArtist(){
        $artist = [];
        $query ='SELECT'
                    . '`ats`.`id`,'
                    . '`ats`.`name`,'
                    . 'IF(`ats`.`birthDate` = \'0000-00-00\', \'Non renseigné\', DATE_FORMAT(`ats`.`birthDate`, \'%d/%m/%Y\')) AS `birthDate`,'
                    . 'IF(`ats`.`deathDate` = \'0000-00-00\', \'\', DATE_FORMAT(`ats`.`deathDate`, \'%d/%m/%Y\')) AS `deathDate`,'
                    . '`ats`.`biography`,'
                    . 'GROUP_CONCAT(DISTINCT `N`.`nationality` SEPARATOR \', \') AS `nationalities`,'
                    . 'GROUP_CONCAT(DISTINCT `C`.`country` SEPARATOR \', \') AS `countries`,'
                    . 'GROUP_CONCAT(DISTINCT `j`.`job` SEPARATOR \', \') AS `jobs`,'
                    . 'IF(AVG(`sc`.`score`) < 0, \'null\', TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
                    . 'IF(AVG(`sc`.`score`) < 0, \'null\', TRUNCATE(AVG(`sc`.`score`), 0)) AS `countStars`,'
                    . 'COUNT(`com`.`id`) AS `comCount`'
                . 'FROM `artists` AS `ats` '
                    . 'LEFT JOIN `AANationalities` AS `AAN` ON `AAN`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `Nationalities` AS `N` ON `N`.`id` = `AAN`.`id_nationalities`'
                    . 'LEFT JOIN `AACountries` AS `AAC` ON `AAC`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `Countries` AS `C` ON `C`.`id` = `AAC`.`id_countries`'
                    . 'LEFT JOIN `artistsJobs` AS `AJ` ON `AJ`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `jobs` AS `j` ON `j`.`id` = `AJ`.`id_jobs`'
                    . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `comments` AS `com` ON `com`.`id_artists` = `ats`.`id`'
                . 'WHERE `ats`.`id` = :id';
        $artist = Database::getInstance()->prepare($query);
        $artist->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($artist->execute()){
            if (is_object($artist)) {
                $result = $artist->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    /**
     * get an artist in artists table with all contents in others tables
     * + user concern
     * @return array
     */
    public function selectArtistUserConnected(){
        $artist = [];
        $query = 'SELECT '
                    . '`ats`.`id`,'
                    . '`ats`.`name`,'
                    . 'IF(`ats`.`birthDate` = \'0000-00-00\', \'Non renseigné\', DATE_FORMAT(`ats`.`birthDate`, \'%d/%m/%Y\')) AS `birthDate`,'
                    . 'IF(`ats`.`deathDate` = \'0000-00-00\', \'\', DATE_FORMAT(`ats`.`deathDate`, \'%d/%m/%Y\')) AS `deathDate`,'
                    . '`ats`.`biography`,'
                    . 'GROUP_CONCAT(DISTINCT `N`.`nationality` SEPARATOR \', \') AS `nationalities`,'
                    . 'GROUP_CONCAT(DISTINCT `C`.`country` SEPARATOR \', \') AS `countries`,'
                    . 'GROUP_CONCAT(DISTINCT `j`.`job` SEPARATOR \', \') AS `jobs`,'
                    . 'IF(AVG(`sc`.`score`) < 0, null, TRUNCATE(AVG(`sc`.`score`), 2)) AS `scoreAVG`,'
                    . 'COUNT(`com`.`id`) AS `comCount`,'
                    . '(SELECT `score` FROM `scores` WHERE `id_artists` = :id AND `id_users` = :id_users) AS `ussc`'
                . 'FROM `artists` AS `ats` '
                    . 'LEFT JOIN `AANationalities` AS `AAN` ON `AAN`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `Nationalities` AS `N` ON `N`.`id` = `AAN`.`id_nationalities`'
                    . 'LEFT JOIN `AACountries` AS `AAC` ON `AAC`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `Countries` AS `C` ON `C`.`id` = `AAC`.`id_countries`'
                    . 'LEFT JOIN `artistsJobs` AS `AJ` ON `AJ`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `jobs` AS `j` ON `j`.`id` = `AJ`.`id_jobs`'
                    . 'LEFT JOIN `scores` AS `sc` ON `sc`.`id_artists` = `ats`.`id`'
                    . 'LEFT JOIN `comments` AS `com` ON `com`.`id_artists` = `ats`.`id`		'
                . 'WHERE `ats`.`id` = :id';
        $artist = Database::getInstance()->prepare($query);
        $artist->bindValue(':id', $this->id, PDO::PARAM_INT);
        $artist->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        if($artist->execute()){
            if (is_object($artist)) {
                $result = $artist->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}