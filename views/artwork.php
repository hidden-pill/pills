<?php
include_once '../config.php';
include_once '../controllers/artworkController.php';
include_once 'header.php';
?>


<div class="artworkPage">
    <img src="../assets/images/artworks/<?= $artworkDetails->id; ?>" />
    <p class="avg"><?= $artworkDetails->scoreAVG; ?></p>
    <h1><?= $artworkDetails->name; ?></h1>
    <div class="rating" id="ratingid_artworks<?= $artworkDetails->id; ?>">
        <?php for($star = 1; $star <= 10; $star++){ ?><i class="material-icons star<?= $star; ?>" score="<?= $star;?>" id_column="<?= $artworkDetails->id; ?>" column="id_artworks"><?php if(isset($_SESSION['id'])){?><?= $artworkDetails->ussc >= $star?'star' : 'star_border'; ?><?php }else{ echo 'star_border'; } ?></i><?php } ?>
    </div>
    <p class="synopsis">
        Synopsis : <br />
        <?= $artworkDetails->synopsis; ?>
    </p>
    <ul class="info">
        <li>Date de sortie : <?= $artworkDetails->releaseDate; ?></li>
        <li>Plateforme : <?= $artworkDetails->plateforms; ?></li>
        <li>Distribution : <?= $artworkDetails->distributor; ?></li>
        <li>Nationalité : <?= $artworkDetails->nationalities; ?></li>
        <li>Tournage : <?= $artworkDetails->countries; ?></li>
        <li>Genre : <?= $artworkDetails->genres; ?></li>
        <li>Trailer : <?= $artworkDetails->trailers; ?></li>
    </ul>
    <h3><?= $artworkDetails->articleType; ?></h3>
</div>
<div class="AAbox">
    <?php foreach($artistList as $ats){ ?>
    <a href="artist-<?= $ats->id; ?>.html" class="AA">
        <img src="../assets/images/artists/<?= $ats->id; ?>" />
        <p><?= $ats->name; ?></p>
        <p><?= $ats->jobs; ?></p>
    </a>
    <?php } ?>
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
