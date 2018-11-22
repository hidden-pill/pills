<?php
include_once '../config.php';
include_once '../controllers/artistController.php';
include_once 'header.php';
?>

<?= $artistDetails->name; ?>

<div class="rating" id="ratingid_artists<?= $artistDetails->id; ?>">
<?php for($star = 1; $star <= 10; $star++){ ?>
    <i class="material-icons star<?= $star; ?>" score="<?= $star;?>" id_column="<?= $artistDetails->id; ?>" column="id_artists">
    <?php if(isset($_SESSION['id'])){?><?= $artistDetails->ussc >= $star?'star' : 'star_border'; ?><?php }else{ echo 'star_border'; } ?>
    </i>
<?php } ?>
    <p class="avg"><?= $artistDetails->scoreAVG; ?></p>
</div>

<?php include_once 'footer.php'; ?>
<script src="assets/js/score.js"></script>