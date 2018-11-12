<?php
include_once 'header.php';
include_once '../controllers/addReviewController.php';
?>
<form action="addReview.php" method="POST" enctype="multipart/form-data">
    <label class="" for="culturalObject">Choix de l'oeuvre culturel</label>
    <select id="culturalObject" name="culturalObject">
    <option selected disabled>Choisir une oeuvre</option>
    <?php foreach ($coList as $co) { ?>
    <option value="<?= $co->id; ?>" <?= $culturalObject == $co->id? 'selected': '';?>><?= $co->name; ?></option>
    <?php } ?>
    </select>

    <label class="" for="title">Titre</label>
    <input id="title" class="" name="title" placeholder="Titre de la critique" type="text" value="<?= $title; ?>" />    
    
    <label class="" for="image">Image</label>
    <input id="image" class="" name="image" type="file" />

    <label class="" for="review">Critique</label>
    <textarea id="review" class="" name="review" placeholder="Texte.." type="review"><?= $review; ?></textarea>
<input type="submit" name="submitReview" />
</form>
<?php include_once 'footer.php'; ?>