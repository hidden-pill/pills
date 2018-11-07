<div class="modal" id="logIn">
    <h1>Connexion</h1>
    <form action="index.php" method="POST">
    <label class="" for="identifier">Votre identifiant</label>
    <input id="identifier" class="" name="identifier" placeholder="Pseudo ou email" type="text" />
    <label class="" for="password">Mot de passe</label>
    <input id="password" class="" name="password" placeholder="password" type="password" />
    <label class="" for="keepMeLogIn">keepMeLogIn</label>
    <p><input id="keepMeLogIn" class="" name="keepMeLogIn" type="checkbox" /> keepMeLogIn</p>
    <input id="submitLogin" class="button" name="submitLogin" type="submit" value="Se connecter" />
    <input class="modal-close" type="button" value="Annuler" />
    <div class="register">
        <a class="button" href="register.php">Créer un compte</a>
    </div>
    </form>
    <button class="close-button"  type="button">
        <span class="modal-close">&times;</span>
    </button>
</div>