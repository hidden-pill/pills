<?php

if(isset($_GET['pseudo'])){
    $pseudo = htmlspecialchars($_GET['pseudo']);

    $userpage = new Users();
    



















} else {
    header('Location:/');
    exit;
}