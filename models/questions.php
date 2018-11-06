<?php

class Questions extends Database {

    public $id = null;
    public $question = null;

    public function __constructor() {
        parent::__construct();
    }

    public function selectQuestions() {
        $question = [];
        $query = 'SELECT `id`, `question` FROM `' .SALT. 'questions`';
        $question = $this->db->query($query);
        if($question->execute()){
            if (is_object($question)) {
                $result = $question->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}