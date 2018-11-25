<?php 

if(isset($_GET['artwork'])){
    $artworkID = $_GET['artwork'];
    $artwork = new Artworks();
    $comment = new Comments();
    $artwork->id = $artworkID;
    if($artwork->checkIfArtworkExist()){
        if(isset($_SESSION['id'])){
            $artwork->id_users = $_SESSION['id'];
            $artworkDetails = $artwork->selectArtworkUserConnected();
            $comment->id_users = $_SESSION['id'];
            $comment->id_artworks = $artworkID;
            $commentList = $comment->selectArtworkCommentsUserConnected();
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