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
    <div class="btn black" id="sendComment" id_column="<?= $_GET['artist']; ?>" column="id_artists">Envoyer le commentaire</div>
<?php include_once 'footer.php'; ?>
