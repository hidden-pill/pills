<?php

class Tags extends Database {

    public $id = null;
    public $tag = null;

    public function __constructor() {
        parent::__construct();
    }
        
    public function selectTags() {
        $tag = [];
        $query = 'SELECT `id`, `tag` FROM `' .SALT. 'tags`';
        $tag = $this->db->query($query);
        if($tag->execute()){
            if (is_object($tag)) {
                $result = $tag->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  
}