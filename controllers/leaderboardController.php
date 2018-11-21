<?php
$limit = 10;

$leaderboard = new Levels();
$leaderboard->page = 0;
$leaderboard->limit = $limit;

if(isset($_GET['page'])){
    if($_GET['page'] != 0){
        $leaderboard->page = ($_GET['page'] - 1) * $limit;
        $leaderboard->limit = $limit;
    }
}
$leaderboardArray = $leaderboard->leaderboard();

$pagesLeaderboard = new Users();
$pagesLeaderboard->limit = $limit;
$pages = $pagesLeaderboard->countPageLeaderboard();
