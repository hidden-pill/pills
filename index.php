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
        <h2><?= $review->title; ?></h2>
<span class="pillIcon" <?php if($review->red != 0 && $review->blue != 0){?> style="background-color: rgb(<?= $review->red > $review->blue? $review->red : 0; ?>, 0, <?= $review->blue > $review->red? $review->blue : 0; ?>)"<?php } ?>>
    <i class="material-icons">add_circle</i>
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
    <pre class="reviewContent"><?= $review->review; ?></pre>
    <div class="reviewFooter">
        <a href="<?= $review->pseudo; ?>">
            <img src="assets/images/<?= $review->imageUs; ?>" />
            <?= $review->pseudo; ?>
        </a>
        <a class="btn waves-effect waves-light black">
            <?= $review->comCount; ?><?= $review->pseudo; ?><?= $review->reviewPastTime; ?><i class="material-icons right">send</i>
        </a>

    </div>
</div>
<?php } ?>

<?php include_once 'views/footer.php'; ?>