<?php
include_once '../config.php';
include_once '../controllers/userPageController.php';
include_once 'header.php';
?>



<div class="userPage">
    <img title="<?= $_GET['pseudo']; ?>" src="../assets/images/users/<?= $userDetails->id ?>" onerror="this.onerror=null;this.src='../assets/images/default/default_profile.png';"  onabort="this.onabort=null;this.src='../assets/images/default/default_profile.png';" style="border: 3px solid <?= $userDetails->color;?>" />
    <h1><?= $_GET['pseudo']; ?></h1>
    <p>Niveau : <?= $userDetails->level ?></p>
    <table>
        <thead>
            <th>Expérience</th>
            <th>Pillules données</th>
            <th>Etoiles données</th>
            <th>Critiques</th>
        </thead>
        <tbody>
            <td><?= $userDetails->experience; ?></td>
            <td><?= $userDetails->countUp; ?></td>
            <td><?= $userDetails->countSc; ?></td>
            <td><?= $userDetails->countRv; ?></td>
        </tbody>
    </table>
    <?php if(isset($_SESSION['id'])){
        if($userDetails->id == $_SESSION['id']){ ?>
        <a href="/<?= $_SESSION['pseudo']; ?>/settings" class="btn" style="background-color: <?= $userDetails->color;?>">Paramètres du compte</a>
        <?php }
    } ?>
</div>

<table>
    <thead>
        <th>Dernières critiques</th>
        <th>Il y a</th>
    </thead>
    <tbody>
        <?php foreach($lastUserReviews as $lastReview){ ?>
        <tr>
            <td><a href="../review-<?= $lastReview->id; ?>.html"><?= $lastReview->title; ?></a></td>
            <td><?= $lastReview->reviewPastTime; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<table>
    <thead>
        <th>Derniers commentaires</th>
        <th>Il y a</th>
    </thead>
    <tbody>
        <?php foreach($lastUserComments as $lastComment){ ?>
        <tr>
            <td><?= $lastComment->comment; ?></td>
            <td><?= $lastComment->commentPastTime; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<?php include_once 'footer.php'; ?>