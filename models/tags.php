<?php

class Tags extends Database {

    public $id = null;
    public $tag = null;
  
    public function selectTags() {
        $tag = [];
        $query = 'SELECT `id`, `tag` FROM `' .SALT. 'tags`';
        $tag = Database::getInstance()->query($query);
        if($tag->execute()){
            if (is_object($tag)) {
                $result = $tag->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  

    public function insertTag(){
        $query = 'INSERT INTO `' .SALT. 'tags`'
        . '(`tag`)'
        . 'VALUES'
        . '(:tag)';
        $artistJob = Database::getInstance()->prepare($query);
        $artistJob->bindValue(':tag', $this->tag, PDO::PARAM_STR);
        return $artistJob->execute();
    }
}
