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
  <link rel="stylesheet" href="<?= $path; ?>assets/css/navbar.css" />
  <link rel="stylesheet" href="<?= $path; ?>assets/css/search.css" />
  <link rel="stylesheet" href="<?= $path; ?>assets/css/test.css" />


</head>

<body>
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="/pills" class="brand-logo">Logo</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a <?= $_SERVER['REQUEST_URI'] == '/pills/trending'? 'class="active"': ''; ?> href="/pills/trending">Tendances</a></li>
        <li class="tab"><a <?= $_SERVER['REQUEST_URI'] == '/pills/new'? 'class="active"': ''; ?> href="/pills/new">Nouveaux</a></li>
        <li class="tab"><a <?= $_SERVER['REQUEST_URI'] == '/pills/top'? 'class="active"': ''; ?> href="/pills/top">Top</a></li>
        <li class="tab"><a <?= $_SERVER['REQUEST_URI'] == '/pills/controversial'? 'class="active"': ''; ?> href="/pills/controversial">Controversé</a></li>
      </ul>
    </div>
  </nav>
<?php var_dump($_SERVER); ?>
<?php include_once 'login.php'; ?>