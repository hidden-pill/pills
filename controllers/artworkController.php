<?php 

if(isset($_GET['artwork'])){
    $artworkID = $_GET['artwork'];
    $artwork = new Artworks();
    $artwork->id = $artworkID;
    if($artwork->checkIfArtworkExist()){
        if(isset($_SESSION['id'])){
            $artwork->id_users = $_SESSION['id'];
            $artworkDetails = $artwork->selectArtworkUserConnected();
        }else{
            $artworkDetails = $artwork->selectArtwork();
        }
    }else{
        header('Location:/');
        exit;
    }
}else {
    header('Location:/');
    exit;
}