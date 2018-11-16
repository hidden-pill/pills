<?php
include_once '../controllers/userPageController.php';
include_once 'header.php';
?>
<img class="userImage" src="../assets/images/users/<?= $pseudo ?>" onerror="this.onerror=null;this.src='../assets/images/users/default_profile.png';"  onabort="this.onabort=null;this.src='../assets/images/users/default_profile.png';" />
