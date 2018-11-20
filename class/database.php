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

    public function deleteToDeleteUser($table) {
        $state = false;
        $query = 'DELETE FROM  `' .SALT.$table. '` WHERE `id_users` = :id_users';
        $delete = Database::getInstance()->prepare($query);
        $delete->bindValue(':id_users', $this->id, PDO::PARAM_INT);
        if ($delete->execute()) { 
            $state = true;
        }
        return $state;
    }

    
    public function updateToDeleteUser($table){
        $state = false;
        $query = 'UPDATE `' .SALT.$table. '` SET `id_users` = 2 WHERE `id_users` = :id_users';
        $update = Database::getInstance()->prepare($query);
        $update->bindValue(':id_users', $this->id, PDO::PARAM_INT);
        if ($update->execute()) { 
            $state = true;
        }
        return $state;
    }

    /**
     * __destruct de la connection à la db
     */
    public function __destruct(){
        $this->db = NULL;
    }
}