<?php
include_once '../config.php';
include_once '../controllers/userPageController.php';
include_once 'header.php';
?>
<img title="<?= $_GET['pseudo']; ?>" src="../assets/images/users/<?= $userDetails->id ?>" onerror="this.onerror=null;this.src='../assets/images/users/default_profile.png';"  onabort="this.onabort=null;this.src='../assets/images/users/default_profile.png';" />
<h1><?= $_GET['pseudo']; ?></h1>
<?php if($userDetails->id == $_SESSION['id']){ ?><a href="#" class="btn">Modifier</a><?php } ?>
<?= $userDetails->experience; ?>
