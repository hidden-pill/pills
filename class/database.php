<?php
/**
 * class Database
 */
class Database {
    
    private static $_db;

    /**
     *  connect to database with singleton
     */
    public static function getInstance() {

        if(is_null(self::$_db)){
            try {
                self::$_db = new PDO('mysql:host=' .HOST. ';port=' .PORT. ';dbname=' .DBNAME. ';charset=' .CHARSET. ';', ACCOUNT, PASSWORD);
                self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //TODO REMOVE TO AVOID DISPLAYING SQL ERROR
            } catch (Exception $e) { // catch error message
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$_db;
    }

    public function getLastInsertId() {
        $result = 0;
        $query = 'SELECT LAST_INSERT_ID() AS `id`';
        $result = self::getInstance()->prepare($query);
        if($result->execute()){
            if (is_object($result)) {
                $result = $result->fetch(PDO::FETCH_COLUMN);
            }
        }
        return $result;
    }

    /**
     * __destruct de la connection à la db
     */
    public function __destruct(){
        $this->db = NULL;
    }
}