<?php
include 'controllers/indexController.php';
$test = 1;
?>
<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>P I L L S</title>
  <link rel="stylesheet" href="assets/css/foundation.css" />
  <link rel="stylesheet" href="assets/css/navbar.css" />
  <link rel="stylesheet" href="assets/css/search.css" />
  <link rel="stylesheet" href="assets/css/test.css" />


</head>

<body>
  <div class="wrapper">
    <div class="one">
      <img id ="logo" src="assets/images/pillslogodef.png" alt="logo" />
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
        <li><a href="trending" <?=$checkTrending; ?>>A la une</a></li>
        <li><a href="hot" <?=$checkHot; ?>>Tendances</a></li>
        <li><a href="created" <?=$checkCreated; ?>>Nouveaux</a></li>
        <li><a href="commented" <?=$checkCommented; ?>>Commentés</a></li>
      </ul>
    </div>
    <div class="four">
      <?php if($test == 1){ ?>
      <ul class="logto">
        <li data-open="logIn" id="logInButton">Se Connecter</li>
        <li id="registerButton"><a href="register.php">S'inscrire</a></li>
      </ul>
      <?php } else { ?>
      <span title="Nom de l'utilisateur">
        <img class="userImage" src="assets/images/profile-picture.jpg" alt="image utilisateur" />
      </span>
<!-- 9/10 here -->



      <?php } ?>
    </div>
  </div>

<?php include 'login.php'; ?>


</body>
<script src="assets/js/vendor/jquery.js"></script>
<script src="assets/js/vendor/what-input.js"></script>
<script src="assets/js/vendor/foundation.min.js"></script>
<script src="assets/js/test.js"></script>
<script src="assets/js/app.js"></script>

</html>