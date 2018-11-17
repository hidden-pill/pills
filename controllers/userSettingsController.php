<?php

if(isset($_GET['pseudo']) && isset( $_SESSION['pseudo'])){
    if($_GET['pseudo'] != $_SESSION['pseudo']){
        header('Location:/');
        exit;
    }
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $userSettings = $user->selectSettingsUser();



























} else {
    header('Location:/');
    exit;
}