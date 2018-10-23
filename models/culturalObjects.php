<?php

class CulturalObjects extends Database {

    public $id = null;
    public $name = null;
    public $releaseDate = null;
    public $synopsis = null;
    public $image = null;
    public $newsletter = null;
    public $budget = null;

    public function __constructor() {
        parent::__construct();
    }
}