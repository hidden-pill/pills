<?php
include_once 'header.php';
include_once '../controllers/addArtworkController.php';
?>
<form action="addArtwork.php" method="POST" enctype="multipart/form-data">
<input name="name" type="text" />
<input name="releaseDate" type="date" />
<textarea class="materialize-textarea" name="synopsis"></textarea>
<input name="budget" type="text" />
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
    <select multiple name="nationalities[]" id="nationalities">
        <option disabled selected>Nationalité</option>
        <?php foreach ($nationalitiesList as $nationality) { ?>
        <option value="<?= $nationality->id; ?>" <?= $nationality == $nationality->id? 'selected': '';?>><?= $nationality->nationality; ?></option>
        <?php } ?>
    </select>
    <label for="nationnalities">Choix de la/des nationalité(s)</label>
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
        <option value="<?= $country->id; ?>" <?= $country == $country->id? 'selected': '';?>><?= $country->country; ?>
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
    <label for="culturalObjects">Choix du/des artistes</label>
</div>
</form>
<?php include_once 'footer.php'; ?>