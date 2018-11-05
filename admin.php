<?php
session_start();
include_once 'config.php';
include_once 'controllers/adminController.php';
?>
<!DOCTYPE html>
<html class="no-js" lang="fr">

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
<?php if($_SESSION['rank'] > 1){?>
<a href="settings.php?table=questions" <?= $_SESSION['rank'] != 3? 'class="not-active"' : ''; ?>>Accéder aux questions</a>
<a href="settings.php?table=ranks" <?= $_SESSION['rank'] != 3? 'class="not-active"' : ''; ?>>Accéder aux rangs des utilisateurs</a>
<a href="index.php">Retour à l'accueil</a>
<?php } else { ?>
<p>Vous n'avez pas accès à cette page</p>
<a href="/">Retour à l'accueil</a>
<?php } ?>
</body>
</html>