</main>
<footer class="page-footer">
  <div class="footer-copyright">
    <div class="container">
        <p>Copyright Pills© 2018 - Tous droits réservés.</p>
    </div>
<?php if(isset($_SESSION['isConnect'])){ ?><a class="right" href="#"><img id="rabbit" src="<?= $path; ?>assets/images/rabbit.png" /></a><?php } ?>
  </div>
</footer>
</body>
<script src="<?= $path; ?>assets/js/jquery-3.3.1.js"></script>
<script src="<?= $path; ?>assets/materialize/js/materialize.js"></script>
<script src="<?= $path; ?>assets/js/app.js"></script>
<script src="<?= $path; ?>assets/js/search.js"></script>
<script src="<?= $path; ?>assets/js/score.js"></script>
<script src="<?= $path; ?>assets/js/vote.js"></script>
<script src="<?= $path; ?>assets/js/comments.js"></script>
</html>