<?php 

if(isset($_GET['artist'])){
    $artistID = $_GET['artist'];
    $artist = new Artists();
    $comment = new Comments();
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
    }else{
        header('Location:/');
        exit;
    }
}else {
    header('Location:/');
    exit;
}