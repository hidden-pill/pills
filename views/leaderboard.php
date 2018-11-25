<?php
include_once 'header.php';
include_once '../controllers/leaderboardController.php';
?>
<?php foreach($leaderboardArray as $leaderboardRow){?>
<p style="background-color : <?= $leaderboardRow->color; ?>"><?= $leaderboardRow->pseudo; ?> | <?= $leaderboardRow->level; ?> | <?= $leaderboardRow->experience; ?></p>
<?php } ?>
<a class="btn" href="?page=<?= $_GET['page'] - 1; ?>">page -</a>
<a class="btn" href="?page=<?= $_GET['page'] + 1; ?>">page +</a>
<?php include 'footer.php'; ?>