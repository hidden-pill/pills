<?php include_once 'views/header.php'; ?>
<?php include_once 'controllers/indexController.php'; ?>

<?php foreach ($reviewsList as $review){ ?>
<div class="review">
    <a href="" class="reviewImage">
      <object class="reviewImage" data="assets/images/<?= $review->image; ?>" title="<?= $review->name; ?>">
        <img class="reviewImage" src="assets/images/default-poster.png" alt="default-poster">
      </object>
      <p><?= $review->id; ?></p>
    </a>
    <div class="reviewTitle">
        <div class="titleTags">
            <a href=""><h2><?= $review->title; ?></h2></a>
            <a href="test"><span class="new badge" data-badge-caption="#<?= $review->tag; ?>"></span></a>
        </div>
        <span class="pillIcon" <?php if($review->red != 0 && $review->blue != 0){?> style="background-color: rgb(<?= $review->red > $review->blue? $review->red : 0; ?>, 0, <?= $review->blue > $review->red? $review->blue : 0; ?>)"<?php } ?>>
    <i class="material-icons voted">add_circle</i>
    <p>
    <?php if(($review->upCount + $review->downCount) != 0){
        if($review->upCount >= $review->downCount){
            echo '+' .$review->upCount;
        }else{
            echo '-' .$review->downCount;
        }
    }else{
        echo '0';
    }?>
    </p>
    <i class="material-icons">remove_circle</i>
</span>
    </div>
    <p class="reviewContent"><?= $review->review; ?></p>
    <div class="reviewFooter">
        <a href="<?= $review->pseudo; ?>">
            <img class="userImage" src="assets/images/<?= $review->imageUs; ?>" />
            <p><?= $review->pseudo; ?></p>
        </a>
        <a class="btn waves-effect waves-light black">
            Voir la critique<i class="material-icons right">send</i>
        </a>

    </div>
</div>
<?php } ?>

<?php include_once 'views/footer.php'; ?>