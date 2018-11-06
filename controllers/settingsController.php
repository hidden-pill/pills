<?php

if(isset($_GET['table'])){
    $table = htmlspecialchars($_GET['table']);
    switch($table) {
    case 'ranks':
        $rank = new Ranks();
        $contentList = $rank->selectRanks();
        break;
    case 'questions':
        $question = new Questions();
        $contentList = $question->selectQuestions();
        break;
    case 'levels':
        $level = new Levels();
        $contentList = $level->selectLevels();
        break;
    case 'nationalities':
        $nationality = new Nationalities();
        $contentList = $nationality->selectNationalities();
        break;
    case 'rewards':
        $reward = new Rewards();
        $contentList = $reward->selectRewards();
        break;
    case 'tags':
        $tag = new Tags();
        $contentList = $tag->selectTags();
        break;
    default:
        header('location: admin.php');
    }
    $column = new Columns();
    $columns = $column->showColumns($table);
}