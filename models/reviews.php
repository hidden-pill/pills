<?php

class Users extends Database {

    public $id = null;
    public $title = null;
    public $review = null;
    public $date = null;
    public $image = null;

    public function __constructor() {
        parent::__construct();
    }
}