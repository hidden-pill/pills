<?php

class Users extends Database {

    public $id = null;
    public $pseudo = null;
    public $password = null;
    public $email = null;
    public $secretAnswer = null;
    public $newsletter = null;
    public $birthDate = null;
    public $creationDate = null;
    public $image = null;

    public function __constructor() {
        parent::__construct();
    }

        public function userConnection() {
        $state = false;
        $query = 'SELECT `pseudo`, `password`, `image` FROM `' .SALT. 'users` WHERE `pseudo` = :identifier OR `email` = :identifier';
        $result = $this->db->prepare($query);
        $result->bindValue(':identifier', $this->identifier, PDO::PARAM_STR);
        if ($result->execute()) { //On vérifie que la requête s'est bien exécutée
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            if (is_object($selectResult)) { //On vérifie que l'on a bien trouvé un utilisateur
                // On hydrate
                $this->pseudo = $selectResult->pseudo;
                $this->password = $selectResult->password;
                $this->image = $selectResult->image;
                $state = true;
            }
        }
        return $state;
    }

        public function userRegister() {
        $query = '';
        $result = $this->db->prepare($query);
        $result->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $result->bindValue(':password', $this->password, PDO::PARAM_STR);
        $result->bindValue(':email', $this->email, PDO::PARAM_STR);
        $result->bindValue(':secretQuestion', $this->secretQuestion, PDO::PARAM_INT);
        $result->bindValue(':secretAnswer', $this->secretAnswer, PDO::PARAM_STR);
        $result->bindValue(':newsletter', $this->newsletter, PDO::PARAM_INT);
        $result->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        return $result->execute();
    }

    public function checkIfUserExist(){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `users` WHERE `pseudo` = :pseudo';
        $result = $this->db->prepare($query);
        $result->bindValue(':pseudo', $this->login, PDO::PARAM_STR);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }
}