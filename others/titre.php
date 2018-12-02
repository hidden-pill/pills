<span 
    class="pillIcon" 
    id="pillid_reviews<?= $review->id; ?>" 
    <?php if(($review->red + $review->blue) != 0){?> 
        style="background-color: 
        rgb(
            <?= $review->red > $review->blue? $review->red : 0; ?>, 
            0, 
            <?= $review->blue > $review->red? $review->blue : 0; ?>
        )"
    <?php } ?>
>
    <i 
        class="material-icons vote upvote <?= $review->classupvote == '1'? 'up': ''; ?>" 
        id_column="<?= $review->id; ?>" 
        upvote="1" 
        column="id_reviews"
    >
        add_circle
    </i>
    <p class="sumupvote">
        <?= $review->upvoteTotal;?>
    </p>
    <i 
        class="material-icons vote downvote <?= $review->classupvote == '0'? 'down': ''; ?>" 
        id_column="<?= $review->id; ?>" 
        upvote="0" 
        column="id_reviews"
    >
        remove_circle
    </i>
</span>





