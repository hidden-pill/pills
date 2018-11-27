<?php include_once 'views/header.php'; ?>
<?php include_once 'controllers/indexController.php'; ?>

<?php foreach ($reviewsList as $review){ ?>
<div class="review">
    <a href="artwork-<?= $review->artworkID; ?>.html" class="reviewImage">
      <object class="reviewImage" data="assets/images/artworks/<?= $review->artworkID; ?>" title="<?= $review->name; ?>" onerror="this.onerror=null;this.src='assets/images/default/default_poster.png';"  onabort="this.onabort=null;this.src='assets/images/default/default_default_posterprofile.png';"">
        <img class="reviewImage" src="assets/images/artworks/default_poster.png" alt="default-poster">
      </object>
      <p><?= $review->scoreAVG; ?></p>
    </a>
    <div class="reviewTitle">
        <div class="titleTags">
            <a href="review-<?= $review->id; ?>.html"><h2><?= $review->title; ?></h2></a>
            <?php foreach(explode(',', $review->tag) as $tag){
                if(!empty($tag)){ ?>
                <a href="?search=<?= $tag; ?>"><span class="new badge" data-badge-caption="#<?= $tag; ?>"></span></a>
                <?php }
            } ?>
        </div>
        <span class="pillIcon" id="pillid_reviews<?= $review->id; ?>" <?php if(($review->red + $review->blue) != 0){?> style="background-color: rgb(<?= $review->red > $review->blue? $review->red : 0; ?>, 0, <?= $review->blue > $review->red? $review->blue : 0; ?>)"<?php } ?>>
            <i class="material-icons vote upvote <?= $review->classupvote == '1'? 'up': ''; ?>" id_column="<?= $review->id; ?>" upvote="1" column="id_reviews">add_circle</i>
            <p class="sumupvote"><?= $review->upvoteTotal;?></p>
            <i class="material-icons vote downvote <?= $review->classupvote == '0'? 'down': ''; ?>" id_column="<?= $review->id; ?>" upvote="0" column="id_reviews">remove_circle</i>
        </span>
    </div>
    <p class="reviewContent"><?= $review->review; ?></p>
    <div class="reviewFooter">
        <a href="<?= $review->pseudo; ?>/">
            <img class="userImage" src="assets/images/users/<?= $review->idUs; ?>" onerror="this.onerror=null;this.src='assets/images/default/default_profile.png';"  onabort="this.onabort=null;this.src='assets/images/default/default_profile.png';" />
            <p><?= $review->pseudo; ?></p>
        </a>
        <a class="btn waves-effect waves-light black" href="review-<?= $review->id; ?>.html">
            Voir la critique<i class="material-icons right">send</i>
        </a>
    </div>
</div>
<?php } ?>
<?php include_once 'views/footer.php'; ?>
