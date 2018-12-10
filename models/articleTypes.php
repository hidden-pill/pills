<?php

class ArticleTypes extends Database {

    public $id = null;
    public $articleType = null;


    /**
     * get all articleTypes
     * @return array
     */
    public function selectArticleTypes() {
        $articleType = [];
        $query = 'SELECT `id`, `articleType` FROM `' .SALT. 'articletypes`';
        $articleType = Database::getInstance()->query($query);
        if($articleType->execute()){
            if (is_object($articleType)) {
                $result = $articleType->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }    
}

