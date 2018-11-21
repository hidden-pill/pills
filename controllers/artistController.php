<?php 

if(isset($_GET['artist'])){
    $artistID = $_GET['artist'];
    $artist = new Artists();
    $artist->id = $artistID;
    if($artist->checkIfArtistExist()){
        if(isset($_SESSION['id'])){
            $artist->id_users = $_SESSION['id'];
            $artistDetails = $artist->selectArtistUserConnected();
        }else{
            $artistDetails = $artist->selectArtist();
        }
    }else{
        header('Location:/');
        exit;
    }
}else {
    header('Location:/');
    exit;
}