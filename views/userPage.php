<?php
include_once '../config.php';
include_once '../controllers/userPageController.php';
include_once 'header.php';
?>
<img title="<?= $_GET['pseudo']; ?>" src="../assets/images/users/<?= $userDetails->id ?>" onerror="this.onerror=null;this.src='../assets/images/users/default_profile.png';"  onabort="this.onabort=null;this.src='../assets/images/users/default_profile.png';" style="border: 3px solid <?= $userLevel->color;?>" />
<h1><?= $_GET['pseudo']; ?></h1>
<?php 
if(isset($_SESSION['id'])){
    if($userDetails->id == $_SESSION['id']){ ?>
    <a href="/<?= $_SESSION['pseudo']; ?>/settings" class="btn">Paramètres du compte</a>
    <?php }
} ?>
<table class="responsive-table">
    <thead>
       <th>exp</th>
    </thead>
    <tbody>
        <td><?= $userDetails->experience; ?></td>
    </tbody>
</table>


<?php include_once 'footer.php'; ?>