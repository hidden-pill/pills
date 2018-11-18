<?php
include_once '../config.php';
include_once '../controllers/userSettingsController.php';
include_once 'header.php';
?>
<p>Veuillez répondre à votre question secrete pour effectuer votre modification</p>
<div class="input-field">
    <input type="text" name="answer" id="answer" />
    <label for="answer"><?= $userSettings->question; ?>*</label>
</div>
<div class="row">
    <div class="input-field col l8 s12">
        <input type="password" name="newpassword" id="newpassword" />
        <label for="newpassword">Nouveau mot de passe</label>
    </div>
    <input type="submit" id="changePassword" class="btn col l4 s12 changebtn" value="changer de mot de passe" />
</div>
<div class="row">
    <div class="input-field col l8 s12">
        <input type="email" name="newemail" id="newemail" />
        <label for="newemail">email@something.com</label>
    </div>
    <input type="submit" name="changeEmail" id="changeEmail" class="btn col l4 s12 changebtn" value="changer votre adresse mail" />
</div>
<form action="" method="POST" enctype="multipart/form-data" class="row">
    <div class="file-field input-field col l8 s12">
        <div class="btn">
            <span>(png, jpg)</span>
            <input type="file" name="image">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>
    <input type="submit" name="changeImage" id="changeImage" class="btn col l4 s12 changebtn" value="changer votre image" />
</form>
<div class="switch">
    <label for="newNewsletter">Se désinscrire de la newsletter</label>
    <label>
    Off
        <input type="checkbox" id="newNewsletter" name="newNewsletter" <?= $userSettings->newsletter == 1? 'checked="true"': '';?>  value="<?= $userSettings->newsletter == 1? '0': '1';?>">
        <span class="lever"></span>
    On
    </label>
</div>
<a class="waves-effect waves-light btn modal-trigger red" href="#modalDELETE">SUPPRIMER MON COMPTE</a>
<div id="modalDELETE" class="modal">
    <div class="modal-content">
        <div class="input-field">
            <input type="text" id="checkDelete" />
            <label for="checkDelete">VEUILLEZ INSCRIRE 'SUPPRIMER'</label>
        </div>
        <a class="btn red" id="deleteAccount">SUPPRIMER MON COMPTE</a>
        <a href="" class="modal-action modal-close btn-flat">ANNULER</a>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script src="../assets/js/userSettings.js"></script>
