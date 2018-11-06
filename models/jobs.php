<?php

class Jobs extends Database {

    public $id = null;

    public function __constructor() {
        parent::__construct();
    }
    
    public function selectJobs() {
        $job = [];
        $query = 'SELECT `id`, `job` FROM `' .SALT. 'jobs`';
        $job = $this->db->query($query);
        if($job->execute()){
            if (is_object($job)) {
                $result = $job->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }    
}