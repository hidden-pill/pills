<?php include_once 'views/header.php'; ?>
<?php include_once 'controllers/indexController.php'; ?>

<?php foreach ($reviewsList as $review){ ?>
<div class="review">
    <a href="" class="reviewImage">
      <object class="reviewImage" data="assets/images/<?= $review->image; ?>" title="<?= $review->co; ?>">
        <img class="reviewImage" src="assets/images/bb-poster.jpg" alt="poster">
      </object>
      <p><?= $review->id; ?></p>
    </a>
    <div class="reviewTitle">
        <h2><?= $review->title; ?></h2>
    </div>
    <p class="reviewContent"><?= $review->review; ?></p>
    <div class="reviewFooter"><?= $review->upCount; ?><?= $review->downCount; ?><?= $review->comCount; ?><?= $review->pseudo; ?><?= $review->date; ?></div>
</div>
<?php } ?>

<?php include_once 'views/footer.php'; ?>