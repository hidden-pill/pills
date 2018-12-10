<?php
$path = $_SERVER['PHP_SELF'] != '/index.php'? '../': '';
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
  <link rel="stylesheet" href="<?= $path; ?>assets/materialize/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?= $path; ?>assets/css/app.css" />
</head>

<body>
  <div class="navbar-fixed">
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="/<?= $_SESSION['pseudo']; ?>/"><i class="material-icons">face</i>Ma page</a></li>
    <li><a href="/<?= $_SESSION['pseudo']; ?>/settings"><i class="material-icons">settings</i>Mes paramètres</a></li>
    <li class="divider"></li>
    <li><a href="/leaderboard.html"><i class="material-icons">poll</i>Classement</a></li>
    <li class="divider"></li>
    <li><a href="/add-review.html"><i class="material-icons">add_circle_outline</i>Créer une critique</a></li>
    <li><a href="/add-artist.html"><i class="material-icons">add_circle_outline</i>Ajouter un artiste</a></li>
    <li><a href="/add-artwork.html"><i class="material-icons">add_circle_outline</i>Ajouter une œuvre</a></li>
    <?php if($_SESSION['rank'] > 1){?>
    <li class="divider"></li>
    <li><a href="<?= $path; ?>views/admin.php"><i class="material-icons">settings</i>Admin</a></li>
    <?php } ?>
    <li class="divider"></li>
    <li><a href="/?action=disconnect"><i class="material-icons">exit_to_app</i>Se déconnecter</a></li>
  </ul>
    <nav class="nav-extended">
      <div class="nav-wrapper">
        <a href="/" class="brand-logo">
          <div id="logo">
            <img src="<?= $path; ?>assets/images/pillsolo.png" />
            <img src="<?= $path; ?>assets/images/pilltxtsolo90.png" />
          </div>
        </a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <?php if($_SERVER['PHP_SELF'] == '/index.php'){ ?>
          <li class="search">
            <input type="text" id="search" placeholder="Rechercher une critique.." class="autocomplete" value="<?= isset($_GET['search'])? $_GET['search']: '' ; ?>" />
            <a class="material-icons" id="submitSearch" href="/trending-search=">search</a>
          </li>
          <?php } ?>
          <?php if(!isset($_SESSION['isConnect'])){ ?>
          <li><a href="<?= $path; ?>views/register.php">S'inscrire</a></li>
          <li><a class="modal-trigger" href="#logIn">Se connecter</a></li>
          <?php } else { ?>
          <li>
            <a class="dropdown-button" href="#!" data-activates="dropdown1">
              <img title="<?= $_SESSION['pseudo']; ?>" class="userImage" src="<?= $path; ?>assets/images/users/<?= $_SESSION['id']; ?>" alt="image utilisateur" onerror="this.onerror=null;this.src='<?= $path; ?>assets/images/default/default_profile.png';"  onabort="this.onabort=null;this.src='<?= $path; ?>assets/images/default/default_profile.png';" />
              <span><?= $_SESSION['pseudo']; ?></span>
              <i class="material-icons right">arrow_drop_down</i>
            </a>
          </li>
          <?php } ?>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <?php if(!isset($_SESSION['isConnect'])){ ?>
          <li><a href="<?= $path; ?>views/register.php">S'inscrire</a></li>
          <li><a class="modal-trigger" href="#logIn">Se connecter</a></li>
          <?php } else { ?>
          <li><a href="/<?= $_SESSION['pseudo']; ?>/"><i class="material-icons">face</i>Ma page</a></li>
          <li><a href="/<?= $_SESSION['pseudo']; ?>/settings"><i class="material-icons">settings</i>Mes paramètres</a></li>
          <li class="divider"></li>
          <li><a href="<?= $path; ?>views/addReview.php"><i class="material-icons">add_circle_outline</i>Créer une critique</a></li>
          <li><a href="<?= $path; ?>views/addArtist.php"><i class="material-icons">add_circle_outline</i>Ajouter un artiste</a></li>
          <li><a href="<?= $path; ?>views/addArtwork.php"><i class="material-icons">add_circle_outline</i>Ajouter une œuvre</a></li>
          <?php if($_SESSION['rank'] > 1){?>
          <li class="divider"></li>
          <li><a href="<?= $path; ?>views/admin.php"><i class="material-icons">settings</i>Admin</a></li>
          <?php } ?>
          <li class="divider"></li>
          <li><a href="?action=disconnect"><i class="material-icons">exit_to_app</i>Se déconnecter</a></li>
          <?php } ?>
        </ul>
      </div>
      <div>
        <ul class="tabs tabs-transparent">
          <li class="tab"><a <?=$_SERVER['REQUEST_URI'] == '/trending' ? 'class="active"' : '' ; ?>href="/trending">Tendances</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI'] == '/new' ? 'class="active"' : '' ; ?>href="/new">Nouveaux</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI'] == '/top' ? 'class="active"' : '' ; ?>href="/top">Top</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI'] == '/controversial' ? 'class="active"' : '' ; ?>href="/controversial">Contesté</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="modal" id="logIn">
    <h1>Connexion</h1>
    <form action="index.php" method="POST">
    <label class="" for="identifier">Votre identifiant</label>
    <input id="identifier" class="" name="identifier" placeholder="Pseudo ou email" type="text" />
    <label class="" for="password">Mot de passe</label>
    <input id="password" class="" name="password" placeholder="password" type="password" />
    <label class="" for="keepMeLogIn">keepMeLogIn</label>
    <p><input id="keepMeLogIn" class="" name="keepMeLogIn" type="checkbox" /> keepMeLogIn</p>
    <input id="submitLogin" class="button" name="submitLogin" type="submit" value="Se connecter" />
    <input class="modal-close" type="button" value="Annuler" />
    <div class="register">
        <a class="button" href="register.php">Créer un compte</a>
    </div>
    </form>
</div>
<main class="container">