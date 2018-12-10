<?php
// set limit per page
$limit = 25;

$page = 1;

$leaderboard = new Levels();
$leaderboard->page = 0;
$leaderboard->limit = $limit;

// check if params page exist, change content according to page set
if(isset($_GET['page'])){
    if($_GET['page'] != 0){
        $leaderboard->page = ($_GET['page'] - 1) * $limit;
        $leaderboard->limit = $limit;
    }
}
// array with leaderboard content
$leaderboardArray = $leaderboard->leaderboard();

$pagesLeaderboard = new Users();
$pagesLeaderboard->limit = $limit;
// pagination array
$pages = $pagesLeaderboard->countPageLeaderboard();
