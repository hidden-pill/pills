<?php
include_once 'header.php';
include_once '../controllers/addArtistController.php';
?>
<form action="addArtist.php" method="POST" enctype="multipart/form-data">
<div class="input-field">
    <select multiple name="select[]">
        <option disabled selected>Choose your option</option>
        <option value="aaaaa">Option 1</option>
        <option value="bbbbb">Option 2</option>
        <option value="ccccc">Option 3</option>
        </select>
        <label>Materialize Multiple Select</label>
    </div>
<input type="submit" name="submitArtist" />
</form>
<?php include_once 'footer.php'; ?>