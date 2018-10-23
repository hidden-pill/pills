<?php

class Artists extends Database {

    public $id = null;
    public $name = null;
    public $birthDate = null;
    public $deathDate = null;
    public $biography = null;
    public $image = null;

    public function __constructor() {
        parent::__construct();
    }
}