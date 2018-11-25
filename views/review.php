<?php
include_once '../config.php';
include_once '../controllers/reviewController.php';
include_once 'header.php';
?>
<div class="pageReview">
    <?php if(file_exists('../assets/images/reviews/' .$reviewDetails->id)){?><img src="../assets/images/reviews/<?= $reviewDetails->id; ?>" /><?php } ?>
    <div class="headerReview">
        <div>
            <h2>
                <?= $reviewDetails->title; ?>
            </h2>
            <span class="pillIcon" id="pillid_reviews<?= $reviewDetails->id; ?>" <?php if(($reviewDetails->red + $reviewDetails->blue) != 0){?> style="background-color: rgb(<?= $reviewDetails->red > $reviewDetails->blue? $reviewDetails->red : 0; ?>, 0,<?= $reviewDetails->blue > $reviewDetails->red? $reviewDetails->blue : 0; ?>)"<?php } ?>>
                <i class="material-icons vote upvote <?= $reviewDetails->classupvote == '1'? 'up': ''; ?>" id_column="<?= $reviewDetails->id; ?>" upvote="1" column="id_reviews">add_circle</i>
                <p class="sumupvote"><?= $reviewDetails->upvoteTotal;?></p>
                <i class="material-icons vote downvote <?= $reviewDetails->classupvote == '0'? 'down': ''; ?>" id_column="<?= $reviewDetails->id; ?>" upvote="0" column="id_reviews">remove_circle</i>
            </span>
        </div>
        <div>
            <a href=""><span class="new badge" data-badge-caption="#<?= $reviewDetails->tag; ?>"></span></a>
            <p>Oeuvre : <a href="artwork-<?= $reviewDetails->artworkID; ?>.html">
                    <?= $reviewDetails->name; ?></a></p>
        </div>
    </div>
    <pre><?= $reviewDetails->review; ?></pre>
    <div class="footerReview">
        <a href="<?= $reviewDetails->pseudo; ?>/">
            <img class="userImage" src="assets/images/users/<?= $reviewDetails->idUs; ?>" onerror="this.onerror=null;this.src='assets/images/users/default_profile.png';"
                onabort="this.onabort=null;this.src='assets/images/users/default_profile.png';" />
            <p>
                <?= $reviewDetails->pseudo; ?>
            </p>
        </a>
        <i class="material-icons">access_time</i>
        <p>
            <?= $reviewDetails->reviewPastTime; ?>
        </p>
    </div>
</div>

<ul>
    <?php foreach($commentList as $com){?>
        <li class="userComment <?= $com->commentsId != null? 'answer': ''; ?>" id="comment<?= $com->id; ?>">
            <img class="userImgComment" src="../assets/images/users/<?= $com->userID; ?>" />
            <div class="commentHeader">
                <h4><?= $com->pseudo; ?></h4>
                <span>Il y a <?= $com->comPastTime; ?></span>
                <span class="pillIcon" id="pillid_comments<?= $com->id; ?>" <?php if(($com->red + $com->blue) != 0){?> style="background-color: rgb(<?= $com->red > $com->blue? $com->red : 0; ?>, 0,<?= $com->blue > $com->red? $com->blue : 0; ?>)"<?php } ?>>
                    <i class="material-icons vote upvote <?= $com->usvote === '1'? 'up': ''; ?>" id_column="<?= $com->id; ?>" upvote="1" column="id_comments">add_circle</i>
                    <p class="sumupvote"><?= $com->upvoteTotal;?></p>
                    <i class="material-icons vote downvote <?= $com->usvote === '0'? 'down': ''; ?>" id_column="<?= $com->id; ?>" upvote="0" column="id_comments">remove_circle</i>
                </span>
            </div>
            <p class="commentContent"><?= $com->comment; ?></p>
            <?php if($com->commentsId == null){ ?>
            <div class="commentFooter">
                <div class="btn black addComment" comment="<?= $com->id; ?>">Répondre</div>
            </div>
            <?php } ?>
        </li>
    <?php } ?>
</ul>

    <textarea id="newComment" class="materialize-textarea"></textarea>
    <div class="btn black" id="sendComment" id_column="<?= $_GET['review']; ?>" column="id_reviews">Envoyer le commentaire</div>

    <?php include_once 'footer.php'; ?>