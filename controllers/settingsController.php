<?php

if(isset($_GET['table'])){
    $table = htmlspecialchars($_GET['table']);
    $column = new Columns();
    $columns = $column->columnsShow($table);

    switch($table) {
    case 'ranks':
        $rank = new Ranks();
        $contentList = $rank->ranksSelect();
        break;
    case 'questions':
        $question = new Questions();
        $contentList = $question->questionsSelect();
        break;
    case 'levels':
        $level = new Levels();
        $contentList = $level->levelsSelect();
        break;
    default;
    }

}