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
  <link rel="stylesheet" href="<?= $path; ?>assets/materialize/css/materialize.min.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?= $path; ?>assets/css/app.css" />


</head>

<body>
  <div class="navbar-fixed">
    <nav class="nav-extended">
      <div class="nav-wrapper">
        <a href="/pills" class="brand-logo">
          <div id="logo">
            <img src="<?= $path; ?>assets/images/pillsolo.png" />
            <img src="<?= $path; ?>assets/images/pilltxtsolo90.png" />
          </div>
        </a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li class="search">
            <div class="search-wrapper card">
              <input type="text" id="autocomplete-input" class="autocomplete" />
              <i class="material-icons">search</i>
            </div>
          </li>
          <li><a href="<?= $path; ?>views/register.php">S'inscrire</a></li>
          <li><a class="modal-trigger" href="#logIn">Se connecter</a></li>
          <?php if(!isset($_SESSION['isConnect'])){ ?>
          <li><a href="<?= $path; ?>views/register.php">S'inscrire</a></li>
          <li><a class="modal-trigger" href="#logIn">Se connecter</a></li>
          <?php } ?>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
      </div>
      <div>
        <ul class="tabs tabs-transparent">
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/trending' ? 'class="active"' : '' ; ?>
              href="/pills/trending">Tendances</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/new' ? 'class="active"' : '' ; ?>
              href="/pills/new">Nouveaux</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/top' ? 'class="active"' : '' ; ?>
              href="/pills/top">Top</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/controversial' ? 'class="active"' : '' ; ?>
              href="/pills/controversial">Contesté</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <?php include_once 'login.php'; ?>