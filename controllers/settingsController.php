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
    case 'VOD':
        $website = new VOD();
        $contentList = $website->selectVOD();
        break;
    case 'countries':
        $country = new Countries();
        $contentList = $country->selectCountries();
        break;
    case 'jobs':
        $job = new Jobs();
        $contentList = $job->selectJobs();
        break;
    case 'genres':
        $genre = new Genres();
        $contentList = $genre->selectGenres();
        break;
    case 'articleTypes':
        $articleType = new ArticleTypes();
        $contentList = $articleType->selectArticleTypes();
        break;
    case 'distributors':
        $distributor = new Distributors();
        $contentList = $distributor->selectDistributors();
        break;
    case 'artists':
        $artist = new Artists();
        $contentList = $artist->selectArtists();
        break;
    case 'culturalObjects':
        $culturalObject = new CulturalObjects();
        $contentList = $culturalObject->selectCulturalObjects();
        break;
    default:
        header('location: admin.php');
    }
    $column = new Columns();
    $columns = $column->showColumns($table);
}