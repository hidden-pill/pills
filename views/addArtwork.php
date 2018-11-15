<?php
include_once 'header.php';
include_once '../controllers/addArtworkController.php';
?>
<form action="addArtwork.php" method="POST" enctype="multipart/form-data">
    <input name="name" type="text" />
    <div class="input-field">
        <select name="articleType" id="articleType">
            <option disabled selected>Type</option>
            <?php foreach ($articleTypesList as $articleType) { ?>
            <option value="<?= $articleType->id; ?>" <?= $articleType == $articleType->id? 'selected': '';?>><?= $articleType->articleType; ?></option>
            <?php } ?>
        </select>
        <label for="articleType">Choix du type d'oeuvre</label>
    </div>
    <input name="releaseDate" type="date" />
    <textarea class="materialize-textarea" name="synopsis"></textarea>
    <input name="budget" type="text" />
    <input name="distributorInput" id="distributorInput" type="text" placeholder="Inscrire un nouveau distributeur ou le choisir dans la selection" />
    <div class="input-field">
        <select name="distributor" id="distributor">
            <option disabled selected>Distributeur</option>
            <?php foreach ($distributorsList as $distributor) { ?>
            <option value="<?= $distributor->id; ?>" <?= $distributor == $distributor->id? 'selected': '';?>><?= $distributor->distributor; ?></option>
            <?php } ?>
        </select>
        <label for="distributor">Choix de la distribution</label>
    </div>
    <div class="input-field">
        <select multiple name="nationalities[]" id="nationalities">
            <option disabled selected>Nationalité</option>
            <?php foreach ($nationalitiesList as $nationality) { ?>
            <option value="<?= $nationality->id; ?>" <?= $nationality == $nationality->id? 'selected': '';?>><?= $nationality->nationality; ?></option>
            <?php } ?>
        </select>
        <label for="nationnalities">Choix de la/des nationalité(s)</label>
    </div>
    <div class="input-field">
        <select multiple name="countries[]" id="countries">
            <option disabled selected>Pays</option>
            <?php foreach ($countriesList as $country) { ?>
            <option value="<?= $country->id; ?>" <?= $country == $country->id? 'selected': '';?>><?= $country->country; ?></option>
            <?php } ?>
        </select>
        <label for="countries">Choix du/des pays</label>
    </div>
    <div class="input-field">
        <select multiple name="artists[]" id="artists">
            <option disabled selected>Artiste</option>
            <?php foreach ($artistsList as $artist) { ?>
            <option value="<?= $artist->id; ?>" <?= $artist == $artist->id? 'selected': '';?>><?= $artist->name; ?></option>
            <?php } ?>
        </select>
        <label for="artists">Choix du/des artistes</label>
    </div>
    <div class="input-field">
        <select multiple name="plateforms[]" id="plateforms">
            <option disabled selected>Plateforme</option>
            <?php foreach ($plateformsList as $plateform) { ?>
            <option value="<?= $plateform->id; ?>" <?= $plateform == $plateform->id? 'selected': '';?>><?= $plateform->plateform; ?></option>
            <?php } ?>
        </select>
        <label for="plateforms">Choix du/des plateforme(s)</label>
    </div>
    <input type="submit" name="submitArtwork" value="Ajouter l' oeuvre" class="waves-effect waves-light btn" />
</form>
<?php include_once 'footer.php'; ?>