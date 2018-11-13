<?php
session_start();
include_once '../config.php';
include_once '../controllers/adminController.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/foundation.css" />
  <style>
    .not-active {
      pointer-events: none;
      cursor: default;
      text-decoration: none;
      color: black;
    }
  </style>
</head>

<body>
  <?php if(isset($_SESSION['rank'])){ ?>
    <?php if($_SESSION['rank'] > 1){?>
    <ul class="vertical menu align-center">
      <li><a href="/pills">Retour à l'accueil</a></li>
      <?php foreach ($tables as $link) {?>
      <li><a href="settings.php?table=<?= $link->Tables_in_pills; ?>"><?= $link->Tables_in_pills; ?></li>
      <?php } ?>
    </ul>
    <?php } ?>
    <?php } else { ?>
    <p>Vous n'avez pas accès à cette page</p>
    <a href="/pills">Retour à l'accueil</a>
  <?php } ?>
</body>

</html>