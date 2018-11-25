<?php
include_once 'header.php';
include_once '../controllers/leaderboardController.php';
?>
<table>
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Niveau</th>
            <th>Expérience</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($leaderboardArray as $leaderboardRow){?>
        <tr style="background-color : <?= $leaderboardRow->color; ?>">
            <td>
                <?= $leaderboardRow->pseudo; ?>
            </td>
            <td>
                <?= $leaderboardRow->level; ?>
            </td>
            <td>
                <?= $leaderboardRow->experience; ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
 <ul class="pagination" id="pagesLeaderboard">
    <?php if(isset($_GET['page'])){ if($_GET['page'] != 1){ ?><li class="waves-effect'"><a href="?page=<?= $_GET['page'] - 1; ?>"><i class="material-icons">chevron_left</i></a></li><?php }} ?>
    <?php for ($page; $page <= $pages; $page++){ ?>
    <li class="<?= $page == $_GET['page'] ? 'active':'waves-effect'; ?>" ><a href="?page=<?= $page; ?>"><?= $page; ?></a></li>
    <?php } ?>
    <?php if(isset($_GET['page'])){ if($_GET['page'] != $pages){ ?><li class="waves-effect'"><a href="?page=<?= $_GET['page'] + 1; ?>"><i class="material-icons">chevron_right</i></a></li><?php }} ?>
    <?php if(!isset($_GET['page']) && $pages > 1){ ?><li class="waves-effect'"><a href="?page=2"><i class="material-icons">chevron_right</i></a></li><?php } ?>
  </ul>
<?php include 'footer.php'; ?>