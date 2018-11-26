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
    public $experience = null;


        public function userConnection() {
        $state = false;
        $query = 'SELECT `id`, `pseudo`, `password`, `id_ranks` FROM `' .SALT. 'users` WHERE `pseudo` = :identifier OR `email` = :identifier';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':identifier', $this->identifier, PDO::PARAM_STR);
        if ($result->execute()) { //On vérifie que la requête s'est bien exécutée
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            if (is_object($selectResult)) { //On vérifie que l'on a bien trouvé un utilisateur
                // On hydrate
                $this->pseudo = $selectResult->pseudo;
                $this->password = $selectResult->password;
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
        $result = Database::getInstance()->prepare($query);
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
        $user = Database::getInstance()->query($query);
        if($user->execute()){
            if (is_object($user)) {
                $result = $user->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }  

    public function selectUser(){
        $user = [];
        $query = 'SELECT '
                    .'`us`.`id`, '
                    .'`us`.`experience`, '
                    .'(SELECT `lvl`.`level` FROM `levels` `lvl`, `users` `us` WHERE `us`.`experience` - `lvl`.`levelxp` >= 0 AND `us`.`pseudo` = :pseudo GROUP BY `lvl`.`id` DESC LIMIT 1) as `level`, '
                    .'(SELECT `lvl`.`color` FROM `levels` `lvl`, `users` `us` WHERE `us`.`experience` - `lvl`.`levelxp` >= 0 AND `us`.`pseudo` = :pseudo GROUP BY `lvl`.`id` DESC LIMIT 1) as `color`,'
                    .'COUNT(DISTINCT `up`.`id`) AS `countUp`,'
                    .'(SELECT SUM(`sc`.`score`) `score` FROM `users` `us` LEFT JOIN `scores` `sc` ON `sc`.`id_users` = `us`.`id` WHERE `pseudo` = :pseudo) as `countSc`,'
                    .'COUNT(DISTINCT `rv`.`id`) AS `countRv`'
                    .'FROM'
                    .'`users` `us`'
                    .'LEFT JOIN `upvotes` `up` ON `up`.`id_users` = `us`.`id`'
                        .'LEFT JOIN `reviews` `rv` ON `rv`.`id_users` = `us`.`id`'
                .'WHERE'
                    .'`pseudo` = :pseudo';
        $user = Database::getInstance()->prepare($query);
        $user->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if($user->execute()){
            if (is_object($user)) {
                $result = $user->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function checkIfPseudoExist(){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'users` WHERE `pseudo` = :pseudo';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    public function checkIfEmailExist(){
        $state = false;
        $query = 'SELECT COUNT(`id`) AS `count` FROM `' .SALT. 'users` WHERE `email` = :email';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':email', $this->email, PDO::PARAM_STR);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $state = $selectResult->count;
        }
        return $state;
    }

    public function selectSettingsUser(){
        $user = [];
        $query = 'SELECT'
	                . '`us`.`id`, `us`.`password`, `us`.`email`, `q`.`question`, `us`.`secretAnswer`, `us`.`newsletter`'
                . 'FROM `' .SALT. 'users` AS `us`'
	                . 'LEFT JOIN `' .SALT. 'questions` AS `q` ON `us`.`id_questions` = `q`.`id`'
                . 'WHERE `us`.`pseudo` = :pseudo';
        $user = Database::getInstance()->prepare($query);
        $user->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if($user->execute()){
            if (is_object($user)) {
                $result = $user->fetch(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

    public function updatePassword(){
        $state = false;
        $query = 'UPDATE `' .SALT. 'users` SET `password` = :newpassword WHERE `pseudo` = :pseudo';
        $user = Database::getInstance()->prepare($query);
        $user->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $user->bindValue(':newpassword', $this->newpassword, PDO::PARAM_STR);
        if ($user->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function updateEmail(){
        $state = false;
        $query = 'UPDATE `' .SALT. 'users` SET `email` = :newemail WHERE `pseudo` = :pseudo';
        $user = Database::getInstance()->prepare($query);
        $user->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $user->bindValue(':newemail', $this->newemail, PDO::PARAM_STR);
        if ($user->execute()) { 
            $state = true;
        }
        return $state;
    }
    
    public function updateNewsletter(){
        $state = false;
        $query = 'UPDATE `' .SALT. 'users` SET `newsletter` = :newnewsletter WHERE `pseudo` = :pseudo';
        $user = Database::getInstance()->prepare($query);
        $user->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $user->bindValue(':newnewsletter', $this->newnewsletter, PDO::PARAM_INT);
        if ($user->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function deleteUser() {
        $state = false;
        $query = 'DELETE FROM  `' .SALT. 'users` WHERE `pseudo` = :pseudo';
        $delete = Database::getInstance()->prepare($query);
        $delete->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        if ($delete->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function countPageLeaderboard(){
        $count = 0;
        $query = 'SELECT CEIL(COUNT(`id` - 1) / :limit) AS `count` FROM `users`';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':limit', $this->limit, PDO::PARAM_INT);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            $count = $selectResult->count;
        }
        return $count;
    }

    public function addUserReward(){
        $state = false;
        $query = 'UPDATE `users` SET `experience` = (`experience` + (SELECT `reward` FROM `rewards` WHERE `id` = :rewardID)) WHERE `id` = :id';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result->bindValue(':rewardID', $this->rewardID, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }

    public function deleteUserReward() {
        $state = false;
        $query = 'UPDATE `users` SET `experience` = (`experience` - (SELECT `reward` FROM `rewards` WHERE `id` = :rewardID)) WHERE `id` = :id';
        $result = Database::getInstance()->prepare($query);
        $result->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result->bindValue(':rewardID', $this->rewardID, PDO::PARAM_INT);
        if ($result->execute()) { 
            $state = true;
        }
        return $state;
    }
}