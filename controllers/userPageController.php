<?php

if(isset($_GET['pseudo'])){
    $pseudo = htmlspecialchars($_GET['pseudo']);
    $userpage = new Users();
    $userpage->pseudo = $pseudo;
    if(!$userpage->checkIfPseudoExist()){
        header('Location:/');
        exit;
    }
    $userDetails = $userpage->selectUser();
    
} else {
    header('Location:/');
    exit;
}