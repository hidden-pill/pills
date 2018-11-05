<?php
session_start();
include_once 'config.php';
include_once 'controllers/settingsController.php';
?>
<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/foundation.css" />
</head>
<body>
<?php if($_SESSION['rank'] > 1){?>
<table>
    <thead>
        <tr>
            <?php foreach ($columns as $col) {
             if($col->Field != 'id'){ ?>
            <th><?= $col->Field; ?></th>
            <?php }} ?>
            <th>Voir/Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contentList as $content) { ?>
            <tr>
                <?php foreach ($columns as $col) {
                 if($col->Field != 'id'){ ?>
                <td><?= $content->{$col->Field}; ?></td>
                <?php }} ?>
                <td><a href="<?= $_SERVER['REQUEST_URI']; ?>&show=<?= $content->id; ?>">Voir la fiche du patient</a></td>
                <td><a href="<?= $_SERVER['REQUEST_URI']; ?>&del=<?= $content->id; ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php">Retour à l'accueil</a>
<?php } else { ?>
<p>Vous n'avez pas accès à cette page</p>
<a href="admin.php">Retour à l'accueil</a>
<?php } ?>
</body>
</html>