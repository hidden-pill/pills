<?php

class ArtistsJobs extends Database {

    public $id = null;
    public $id_artists = null;
    public $id_jobs = null;

    /**
     * insert artist and job ids into table ArtistsJobs
     * @return bool
     */
    public function insertArtistsJobs(){
        $query = 'INSERT INTO `' .SALT. 'artistsJobs`'
        . '(`id_artists`, `id_jobs`)'
        . 'VALUES'
        . '(:id_artists, :id_jobs)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':id_jobs', $this->job, PDO::PARAM_INT);
        $artistJob->bindValue(':id_artists', $this->artistID, PDO::PARAM_INT);
        return $artistJob->execute();
    }
}