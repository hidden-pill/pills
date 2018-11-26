<?php 

if(isset($_GET['artist'])){
    $artistID = $_GET['artist'];
    $artist = new Artists();
    $comment = new Comments();
    $artwork = new AA();
    $artist->id = $artistID;
    if($artist->checkIfArtistExist()){
        if(isset($_SESSION['id'])){
            $artist->id_users = $_SESSION['id'];
            $artistDetails = $artist->selectArtistUserConnected();
            $comment->id_users = $_SESSION['id'];
            $comment->id_artists = $artistID;
            $commentList = $comment->selectArtistCommentsUserConnected();
        }else{
            $artistDetails = $artist->selectArtist();
        }
        $artwork->id_artists = $artistID;
        $artworkList = $artwork->selectArtistArtworks();
    }else{
        header('Location:/');
        exit;
    }
}else {
    header('Location:/');
    exit;
}