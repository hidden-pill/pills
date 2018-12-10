<?php

class Genres extends Database {

    public $id = null;
    public $genre = null;

    /**
     * get all genre from genres table
     * @return array
     */
    public function selectGenres() {
        $genre = [];
        $query = 'SELECT `id`, `genre` FROM `' .SALT. 'genres`';
        $genre = Database::getInstance()->query($query);
        if($genre->execute()){
            if (is_object($genre)) {
                $result = $genre->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}