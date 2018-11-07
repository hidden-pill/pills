<?php
session_start();
$path = $_SERVER['PHP_SELF'] != '/pills/index.php'? '../': '';
include_once $path.'config.php';
include_once $path.'controllers/headerController.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>P I L L S</title>
  <link rel="stylesheet" href="<?= $path; ?>assets/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?= $path; ?>assets/css/navbar.css" />
  <link rel="stylesheet" href="<?= $path; ?>assets/css/search.css" />
  <link rel="stylesheet" href="<?= $path; ?>assets/css/test.css" />


</head>

<body>
  <div class="wrapper">
    <div class="one">
      <img id ="logo" src="<?= $path; ?>assets/images/pillslogodef.png" alt="logo" />
    </div>
    <div class="two input-group input-group-rounded">
    <div class="chips-autocomplete"></div>
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
        <li id="logInButton"><a href="#logIn"  class="modal-trigger">Se Connecter</a></li>
        <li id="registerButton"><a href="<?= $path; ?>views/register.php">S'inscrire</a></li>
        
      </ul>
      <?php } else { ?>
      <span title="<?= $_SESSION['pseudo']; ?>">
        <img class="userImage" src="<?= $path; ?>assets/images/<?= $_SESSION['image']; ?>" alt="image utilisateur" />
      </span>
      <a href="<?= $path; ?>views/addReview.php">Créer une critique</a>
      <a href="?action=disconnect">Se déconnecter</a>
        <?php if($_SESSION['rank'] > 1){?>
          <a href="<?= $path; ?>views/admin.php">Admin</a>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

<?php include_once 'login.php'; ?>