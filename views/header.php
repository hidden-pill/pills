<?php
session_start();
if ($_SERVER['PHP_SELF'] == '/pills/index.php'){
  include_once 'config.php';
  include_once 'controllers/headerController.php';
} else {
  include_once '../config.php';
  include_once '../controllers/headerController.php';
}
?>
<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>P I L L S</title>
  <?php if ($_SERVER['PHP_SELF'] == '/pills/index.php'){ ?>
  <link rel="stylesheet" href="assets/css/foundation.css" />
  <link rel="stylesheet" href="assets/css/navbar.css" />
  <link rel="stylesheet" href="assets/css/search.css" />
  <link rel="stylesheet" href="assets/css/test.css" />
  <?php } else {?>
  <link rel="stylesheet" href="../assets/css/foundation.css" />
  <link rel="stylesheet" href="../assets/css/navbar.css" />
  <link rel="stylesheet" href="../assets/css/search.css" />
  <link rel="stylesheet" href="../assets/css/test.css" />
  <?php } ?>

</head>

<body>
  <div class="wrapper">
    <div class="one">
      <img id ="logo" src="<?= $_SERVER['PHP_SELF'] != '/pills/index.php'? '../': '' ?>assets/images/pillslogodef.png" alt="logo" />
    </div>
    <div class="two input-group input-group-rounded">
      <input class="input-group-field" type="search" placeholder="Recherche" />
      <div class="input-group-button">
        <input type="submit" class="button secondary" value="Rechercher" />
        <i class="fas fa-search"></i>
      </div>
    </div>
    <div class="three hover-underline-menu" data-menu-underline-from-center>
      <ul class="menu align-center">
        <li><a href="/pills/trending" <?=$checkTrending; ?>>A la une</a></li>
        <li><a href="/pills/hot" <?=$checkHot; ?>>Tendances</a></li>
        <li><a href="/pills/created" <?=$checkCreated; ?>>Nouveaux</a></li>
        <li><a href="/pills/commented" <?=$checkCommented; ?>>Commentés</a></li>
      </ul>
    </div>
    <div class="four">
      <?php if(!isset($_SESSION['isConnect'])){ ?>
      <ul class="logto">
        <li data-open="logIn" id="logInButton">Se Connecter</li>
        <li id="registerButton"><a href="views/register.php">S'inscrire</a></li>
      </ul>
      <?php } else { ?>
      <span title="<?= $_SESSION['pseudo']; ?>">
        <img class="userImage" src="<?= $_SERVER['PHP_SELF'] != '/pills/index.php'? '../': '' ?>assets/images/<?= $_SESSION['image']; ?>" alt="image utilisateur" />
      </span>
      <a href="views/addReview.php">Créer une critique</a>
      <a href="?action=disconnect">Se déconnecter</a>
        <?php if($_SESSION['rank'] > 1){?>
          <a href="views/admin.php">Admin</a>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

<?php include 'login.php'; ?>