<?php
include_once '../config.php';
include_once '../controllers/registerController.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../assets/css/register.css" rel="stylesheet" />
</head>

<body>
    <form method="POST" action="register.php">
        <h1>Inscription</h1>
        <input id="pseudo" class="" name="pseudo" placeholder="Pseudo" type="text" value="<?= $pseudo; ?>" />
        <div id="birthDate">
            <input id="day" class="birthDate" name="day" placeholder="Jour" type="text" value="<?= $day; ?>" />
            <select id="month" name="month">
                <option selected disabled>Mois</option>
                <option value="1" <?= $month == 1? 'selected': '';?>>Janvier</option>
                <option value="2" <?= $month == 2? 'selected': '';?>>Février</option>
                <option value="3" <?= $month == 3? 'selected': '';?>>Mars</option>
                <option value="4" <?= $month == 4? 'selected': '';?>>Avril</option>
                <option value="5" <?= $month == 5? 'selected': '';?>>Mai</option>
                <option value="6" <?= $month == 6? 'selected': '';?>>Juin</option>
                <option value="7" <?= $month == 7? 'selected': '';?>>Juillet</option>
                <option value="8" <?= $month == 8? 'selected': '';?>>Aout</option>
                <option value="9" <?= $month == 9? 'selected': '';?>>Septembre</option>
                <option value="10" <?= $month == 10? 'selected': '';?>>Octobre</option>
                <option value="11" <?= $month == 11? 'selected': '';?>>Novembre</option>
                <option value="12" <?= $month == 12? 'selected': '';?>>Décembre</option>
            </select>
            <input id="year" class="birthDate" name="year" placeholder="Année" type="text" value="<?= $year; ?>" />
        </div>
        <input id="password" name="password" placeholder="Mot de passe" type="password" />
        <input id="email" class="" name="email" placeholder="email@email.com" type="mail" value="<?= $email; ?>" />
        <select id="secretQuestion" name="secretQuestion">
            <option selected disabled>Choisir une question secrete</option>
            <?php foreach ($questionsList as $question) { ?>
            <option value="<?= $question->id; ?>" <?= $secretQuestion == $question->id? 'selected': '';?>><?= $question->question; ?></option>
            <?php } ?>
        </select>
        <input id="secretAnswer" class="" name="secretAnswer" placeholder="Réponse secrete" type="text" value="<?= $secretAnswer; ?>" />
        <label><input id="newsletter" class="" name="newsletter" type="checkbox" value="1" <?= $newsletter == 1? 'checked': '';?> /> S'inscrire à la newsletter</label>
        <p>En appuyant sur le bouton "Créer un compte", vous acceptez notre <a>politique de confidentialité</a>.</p>
        <input id="submitRegister" name="submitRegister" type="submit" value="Créer un compte" />
        <?php if(!empty($_POST['submitRegister']) && count($formError) == 0){ ?>
        <div class="success">
            <p>Votre compte a été créé</p>
            <a href="/">Retour à l'accueil</a>
        </div>
        <?php } ?>
    </form>
</body>

</html>