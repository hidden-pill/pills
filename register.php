<link rel="stylesheet" href="assets/css/foundation.css" />
<link rel="stylesheet" href="assets/css/navbar.css" />
<link href="assets/css/test.css" rel="stylesheet" />
<link href="assets/css/register.css" rel="stylesheet" />

<form method="POST" action="register.php">
    <h1>Inscription</h1>

    
    <label class="" for="pseudo">pseudo</label>
    <input id="pseudo" class="" name="pseudo" placeholder="Pseudo" type="text" value="" />

        <div id="birthDate">
        <label class="label" for="day">Jour</label>
        <label class="label" for="month">Mois</label>
        <label class="label" for="year">Année</label>
        <input id="day" class="birthDate" name="day" placeholder="Jour" type="text" value="" />
        <select id="month" name="month">
            <option selected disabled>Mois</option>
            <option value="1">Janvier</option>
            <option value="2">Février</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Juillet</option>
            <option value="8">Aout</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Décembre</option>
        </select>
        <input id="year" class="birthDate" name="year" placeholder="Année" type="text" value="" />
    </div>

    <label class="" for="password">password</label>
    <input id="password" class="birthDate" name="password" placeholder="Mot de passe" type="password" value="" />

    <label class="" for="email">email</label>
    <input id="email" class="" name="email" placeholder="email@email.com" type="mail" value="" />

    <label class="" for="secretQuestion">secret question</label>
    <select id="secretQuestion" name="secretQuestion">
        <option selected disabled>Choisir une question secrete</option>
        <option value="1">Bidule?</option>
        <option value="2">Truc?</option>
    </select>

    <label class="" for="secretAnswer">secret answer</label>
    <input id="secretAnswer" class="" name="secretAnswer" placeholder="Réponse secrete" type="text" value="" />

    <label class="" for="newsletter">newsletter</label>
    <input id="newsletter" class="" name="newsletter" type="checkbox" value="" />
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
        Quasi quas ab quia id alias, architecto quod nesciunt aliquid 
        omnis inventore vero recusandae obcaecati pariatur facilis minus, 
        cumque nobis voluptas aspernatur.
    </p>
    <input id="submitRegister" class="button expanded" name="submitRegister" type="submit" value="Créer un compte" />

</form>