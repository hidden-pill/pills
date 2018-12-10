<?php 
//check if id artwork is in url
if(isset($_GET['artwork'])){
    $artworkID = $_GET['artwork'];
    $artwork = new Artworks();
    $comment = new Comments();
    $artist = new AA();
    $artwork->id = $artworkID;
    // check if id in url exists
    if($artwork->checkIfArtworkExist()){
        // check if user if connect (not same method)
        if(isset($_SESSION['id'])){
            $artwork->id_users = $_SESSION['id'];
            $artworkDetails = $artwork->selectArtworkUserConnected();
            $comment->id_users = $_SESSION['id'];
            $comment->id_artworks = $artworkID;
            $commentList = $comment->selectArtworkCommentsUserConnected();
        }else{ //else simple method
            $artworkDetails = $artwork->selectArtwork();
        }
        $artist->id_artworks = $artworkID;
        $artistList = $artist->selectArtworkArtists();
    }else{ // if not exists, user redirect to homepage
        header('Location:/');
        exit;
    }
}else { // if artwork isn't in url, user redirect to homepage
    header('Location:/');
    exit;
}