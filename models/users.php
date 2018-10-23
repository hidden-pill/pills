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
}