<?php include_once 'views/header.php'; ?>
<?php include_once 'controllers/indexController.php'; ?>

<?php foreach ($reviewsList as $review){ ?>
<div class="review">
    <a href="" class="reviewImage">
      <object class="reviewImage" data="assets/images/artworks/<?= $review->artworkID; ?>" title="<?= $review->name; ?>" onerror="this.onerror=null;this.src='assets/images/artworks/default_poster.png';"  onabort="this.onabort=null;this.src='assets/images/artworks/default_default_posterprofile.png';"">
        <img class="reviewImage" src="assets/images/artworks/default_poster.png" alt="default-poster">
      </object>
      <p><?= $review->scoreAVG; ?></p>
    </a>
    <div class="reviewTitle">
        <div class="titleTags">
            <a href=""><h2><?= $review->title; ?></h2></a>
            <a href=""><span class="new badge" data-badge-caption="#<?= $review->tag; ?>"></span></a>
        </div>
        <span class="pillIcon" <?php if(($review->red + $review->blue) != 0){?> style="background-color: rgb(<?= $review->red > $review->blue? $review->red : 0; ?>, 0, <?= $review->blue > $review->red? $review->blue : 0; ?>)"<?php } ?>>
    <i class="material-icons" id="plus" review="2">add_circle</i>
    <p><?= $review->upCount >= $review->downCount? '+' .$review->upCount: '-' .$review->downCount;?></p>
    <i class="material-icons">remove_circle</i>
</span>
    </div>
    <p class="reviewContent"><?= $review->review; ?></p>
    <div class="reviewFooter">
        <a href="<?= $review->pseudo; ?>/">
            <img class="userImage" src="assets/images/users/<?= $review->idUs; ?>" onerror="this.onerror=null;this.src='assets/images/users/default_profile.png';"  onabort="this.onabort=null;this.src='assets/images/users/default_profile.png';" />
            <p><?= $review->pseudo; ?></p>
        </a>
        <a class="btn waves-effect waves-light black">
            Voir la critique<i class="material-icons right">send</i>
        </a>

    </div>
</div>
<?php } ?>

<?php include_once 'views/footer.php'; ?>