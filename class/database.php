<?php
/**
 * class Database
 */
class Database {
    
    protected $db;
    private $host = '';
    private $port = '';
    private $dbname = '';
    private $charset = '';
    private $account = '';
    private $password = '';

    /**
     * __construct lorsqu'on veut se connecter à la bdd
     */
    public function __construct() {
        // essai de connection à la bdd
        $this->host = HOST;
        $this->port = PORT;
        $this->dbname = DBNAME;
        $this->charset = CHARSET;
        $this->account = ACCOUNT;
        $this->password = PASSWORD;

        try {
            $this->db = new PDO('mysql:host=' .$this->host. ';port=' .$this->port. ';dbname=' .$this->dbname. ';charset=' .$this->charset. ';' .$this->account, $this->password);
        } catch (Exception $e) { //si la connection echoue on affiche le message d'erreur
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * __destruct de la connection à la db
     */
    public function __destruct(){
        $this->db = NULL;
    }
}