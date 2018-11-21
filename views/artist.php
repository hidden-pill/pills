<?php
include_once '../config.php';
include_once '../controllers/artistController.php';
include_once 'header.php';
?>

<?= $artistDetails->name; ?>
<?= $artistDetails->score; ?>


<?php include_once 'footer.php'; ?>