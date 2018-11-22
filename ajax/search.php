<?php
include_once '../config.php';

if(isset($_POST['search'])){
    $search = trim(htmlspecialchars($_POST['search']));
    $reviews = new Reviews();
    if(isset($_SESSION['id'])){
        if(is_numeric($_SESSION['id'])){
            $reviews->id_users = $_SESSION['id'];
            $reviews->search = $search;
            $reviewsList = $reviews->selectReviewsUserConnected($order);
        }else{
            $reviewsList = $reviews->selectReviews($order);
        }
    }else{
        $reviewsList = $reviews->selectReviews($order);
    }

}





/*SELECT 
    DISTINCT reviews.id
FROM
    `reviews`
	LEFT JOIN
    `artworks` ON artworks.id = reviews.id_artworks
    LEFT JOIN
    `aa` ON aa.id_artworks = artworks.id
        LEFT JOIN
    `artists` ON artists.id = aa.id_artworks
	LEFT JOIN
    `reviewsTags` ON reviewsTags.id_reviews = reviews.id
    	LEFT JOIN
    `tags` ON tags.id = reviewsTags.id_tags
    
        WHERE reviews.title LIKE '%a%' OR artworks.name LIKE '%a%' OR artists.name LIKE '%a%' OR tags.tag = '%a%'*/