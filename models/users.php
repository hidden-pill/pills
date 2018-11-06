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
    public $experience = null;

    public function __constructor() {
        parent::__construct();
    }

        public function userConnection() {
        $state = false;
        $query = 'SELECT `id`, `pseudo`, `password`, `image`, `id_ranks` FROM `' .SALT. 'users` WHERE `pseudo` = :identifier OR `email` = :identifier';
        $result = $this->db->prepare($query);
        $result->bindValue(':identifier', $this->identifier, PDO::PARAM_STR);
        if ($result->execute()) { //On vérifie que la requête s'est bien exécutée
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            if (is_object($selectResult)) { //On vérifie que l'on a bien trouvé un utilisateur
                // On hydrate
                $this->pseudo = $selectResult->pseudo;
                $this->password = $selectResult->password;
                $this->image = $selectResult->image;
                $this->id_ranks = $selectResult->id_ranks;
                $this->id = $selectResult->id;
                $state = true;
            }
        }
        return $state;
    }

        public function userInsert() {
        $query = 'INSERT INTO `' .SALT. 'users`'
               . '(`pseudo`, `birthDate`, `password`, `email`, `id_questions`, `secretAnswer`, `newsletter`)'
               . 'VALUES '
               . '(:pseudo, :birthDate, :password, :email, :secretQuestion, :secretAnswer, :newsletter)';
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
    
    public function selectUsers() {
        $user = [];
        $query = 'SELECT `id`, `pseudo`, `birthdate`, `email`, `creationDate` FROM `' .SALT. 'users`';
        $user = $this->db->query($query);
        if($user->execute()){
            if (is_object($user)) {
                $result = $user->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  
}