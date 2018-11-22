<?php
include_once '../config.php';
include_once '../controllers/artworkController.php';
include_once 'header.php';
?>

<?= $artworkDetails->name; ?>

<div class="rating" id="ratingid_artworks<?= $artworkDetails->id; ?>">
<?php for($star = 1; $star <= 10; $star++){ ?><i class="material-icons star<?= $star; ?>" score="<?= $star;?>" id_column="<?= $artworkDetails->id; ?>" column="id_artworks"><?php if(isset($_SESSION['id'])){?><?= $artworkDetails->ussc >= $star?'star' : 'star_border'; ?><?php }else{ echo 'star_border'; } ?></i><?php } ?>
    <p class="avg"><?= $artworkDetails->scoreAVG; ?></p>
</div>

<?php include_once 'footer.php'; ?>
<script src="assets/js/score.js"></script>