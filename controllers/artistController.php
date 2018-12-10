<?php 

//check if id artist is in url
if(isset($_GET['artist'])){
    $artistID = $_GET['artist'];
    $artist = new Artists();
    $comment = new Comments();
    $artwork = new AA();
    $artist->id = $artistID;
    // check if id in url exists
    if($artist->checkIfArtistExist()){
        // check if user if connect (not same method)
        if(isset($_SESSION['id'])){
            $artist->id_users = $_SESSION['id'];
            $artistDetails = $artist->selectArtistUserConnected();
            $comment->id_users = $_SESSION['id'];
            $comment->id_artists = $artistID;
            $commentList = $comment->selectArtistCommentsUserConnected();
        }else{ //else simple method
            $artistDetails = $artist->selectArtist();
        }
        $artwork->id_artists = $artistID;
        $artworkList = $artwork->selectArtistArtworks();
    }else{ // if not exists, user redirect to homepage
        header('Location:/');
        exit;
    }
}else { // if artist isn't in url, user redirect to homepage
    header('Location:/');
    exit;
}