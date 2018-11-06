<?php

class Distributors extends Database {

    public $id = null;
    public $distributor = null;

    public function __constructor() {
        parent::__construct();
    }
        
    public function selectDistributors() {
        $distributor = [];
        $query = 'SELECT `id`, `distributor` FROM `' .SALT. 'distributors`';
        $distributor = $this->db->query($query);
        if($distributor->execute()){
            if (is_object($distributor)) {
                $result = $distributor->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  
}