<?php
include_once 'header.php';
include_once '../controllers/addReviewController.php';
?>
<form action="add-review.html" method="POST" enctype="multipart/form-data">
    <label class="" for="artwork">Choix de l'oeuvre</label>
    <select id="artwork" name="artwork">
    <option selected disabled>Choisir une oeuvre</option>
    <?php foreach ($artworksList as $artwork) { ?>
    <option value="<?= $artwork->id; ?>" <?= $artwork == $artwork->id? 'selected': '';?>><?= $artwork->name; ?></option>
    <?php } ?>
    </select>
    <label class="" for="title">Titre</label>
    <input id="title" class="" name="title" placeholder="Titre de la critique" type="text" value="<?= $title; ?>" />    
    <div class="input-field">
        <input name="tagInputs[]" id="tagInputs" type="text" />
        <label for="tagInputs">Création d'un tag</label>
    </div>
    <div class="input-field">
        <select multiple name="tags[]" id="tags">
            <option disabled selected>tag</option>
            <?php foreach ($tagsList as $tag) { ?>
            <option value="<?= $tag->id; ?>" <?= $tag == $tag->id? 'selected': '';?>><?= $tag->tag; ?></option>
            <?php } ?>
        </select>
        <label for="tags">Choix de la/des tag(s)</label>
    </div>
    <div class="file-field input-field">
      <div class="btn">
        <span>image (png,jpg)</span>
        <input type="file" name="image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>

    <label class="" for="review">Critique</label>
    <textarea id="review" class="" name="review" placeholder="Texte.." type="review"><?= $review; ?></textarea>
<input type="submit" name="submitReview" />
</form>
<?php include_once 'footer.php'; ?>