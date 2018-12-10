<?php

class Questions extends Database {

    public $id = null;
    public $question = null;


    /**
     * get all question in questions table
     * @return array
     */
    public function selectQuestions() {
        $question = [];
        $query = 'SELECT `id`, `question` FROM `' .SALT. 'questions`';
        $question = Database::getInstance()->query($query);
        if($question->execute()){
            if (is_object($question)) {
                $result = $question->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }
}