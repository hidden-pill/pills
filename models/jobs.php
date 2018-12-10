<?php

class Jobs extends Database {

    public $id = null;


    /**
     * get all job from jobs table
     * @return array
     */
    public function selectJobs() {
        $job = [];
        $query = 'SELECT `id`, `job` FROM `' .SALT. 'jobs`';
        $job = Database::getInstance()->query($query);
        if($job->execute()){
            if (is_object($job)) {
                $result = $job->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }    
}