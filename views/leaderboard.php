<?php
include_once 'header.php';
include_once '../controllers/leaderboardController.php';
?>
<?php foreach($leaderboardArray as $leaderboardRow){?>
<p><?= $leaderboardRow->pseudo; ?></p>
<p><?= $leaderboardRow->level; ?></p>
<p><?= $leaderboardRow->color; ?></p>
<p><?= $leaderboardRow->experience; ?></p>
<?php } ?>
<?= $pages; ?>
<?php include 'footer.php'; ?>