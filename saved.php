
  <div class="wrapper">
    <div class="one">
      <img id ="logo" src="<?= $path; ?>assets/images/pillslogodef.png" alt="logo" />
    </div>
    <div class="two input-group input-group-rounded">
    <div class="chips-autocomplete"></div>
      <div class="input-group-button">
        <input type="submit" class="button secondary" value="Rechercher" />
        <i class="fas fa-search"></i>
      </div>
    </div>
    <div class="three hover-underline-menu" data-menu-underline-from-center>
      <ul class="menu align-center">
        <li><a href="/pills/trending" <?=$checkTrending; ?>>A la une</a></li>
        <li><a href="/pills/hot" <?=$checkHot; ?>>Tendances</a></li>
        <li><a href="/pills/created" <?=$checkCreated; ?>>Nouveaux</a></li>
        <li><a href="/pills/commented" <?=$checkCommented; ?>>Commentés</a></li>
      </ul>
    </div>
    <div class="four">
      <?php if(!isset($_SESSION['isConnect'])){ ?>
      <ul class="logto">
        <li id="logInButton"><a href="#logIn"  class="modal-trigger">Se Connecter</a></li>
        <li id="registerButton"><a href="<?= $path; ?>views/register.php">S'inscrire</a></li>
        
      </ul>
      <?php } else { ?>
      <span title="<?= $_SESSION['pseudo']; ?>">
        <img class="userImage" src="<?= $path; ?>assets/images/<?= $_SESSION['image']; ?>" alt="image utilisateur" />
      </span>
      <a href="<?= $path; ?>views/addReview.php">Créer une critique</a>
      <a href="?action=disconnect">Se déconnecter</a>
        <?php if($_SESSION['rank'] > 1){?>
          <a href="<?= $path; ?>views/admin.php">Admin</a>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

    <div class="navbar-fixed">
    <nav class="nav-extended">
      <div class="nav-wrapper">
        <a href="/pills" class="brand-logo">
          <div id="logo">
            <img src="<?= $path; ?>assets/images/pillsolo.png" />
            <img src="<?= $path; ?>assets/images/pilltxtsolo90.png" />
          </div>
        </a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><form action="#" method="POST"><div class="chips chips-autocomplete"></div><input type="submit" name="test" /></form></li>
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
      </div>
      <div>
        <ul class="tabs tabs-transparent">
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/trending' ? 'class="active"' : '' ; ?>
              href="/pills/trending">Tendances</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/new' ? 'class="active"' : '' ; ?>
              href="/pills/new">Nouveaux</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/top' ? 'class="active"' : '' ; ?>
              href="/pills/top">Top</a></li>
          <li class="tab"><a <?=$_SERVER['REQUEST_URI']=='/pills/controversial' ? 'class="active"' : '' ; ?>
              href="/pills/controversial">Contesté</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <?= $review->pillColor < 0? 255 + $review->pillColor: 255; ?>

  <?= $review->comCount; ?><?= $review->pseudo; ?><?= $review->reviewPastTime; ?>