<?php
include_once 'header.php';
include_once '../controllers/addArtistController.php';
?>
<form action="addArtist.php" method="POST" enctype="multipart/form-data">
    <input name="name" type="text" />
    <div class="input-field">
        <select multiple name="jobs[]" id="jobs">
            <option value="1" disabled selected>Métier</option>
            <?php foreach ($jobsList as $job) { ?>
            <?php if($job->id != 1){ ?><option value="<?= $job->id; ?>" <?= $job == $job->id? 'selected': '';?>><?= $job->job; ?></option><?php } ?>
            <?php } ?>
        </select>
        <label for="jobs">Choix du/des métier(s)</label>
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
        <select multiple name="culturalObjects[]" id="culturalObjects">
            <option disabled selected>Oeuvre</option>
            <?php foreach ($coList as $co) { ?>
            <option value="<?= $co->id; ?>" <?= $co == $co->id? 'selected': '';?>><?= $co->name; ?></option>
            <?php } ?>
        </select>
        <label for="culturalObjects">Choix du/des oeuvres</label>
    </div>
    <input name="birthDate" type="date" />
    <input name="deathDate" type="date" />
    <textarea id="textarea1" class="materialize-textarea" name="bio"></textarea>
    <label for="textarea1">Textarea</label>
    <div class="file-field input-field">
      <div class="btn">
        <span>PHoto (.png)</span>
        <input type="file" name="image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
<input type="submit" name="submitArtist" value="Ajouter l' artiste" class="waves-effect waves-light btn" />
</form>
<?php include_once 'footer.php'; ?>