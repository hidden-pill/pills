<?php

$errorArtworkForm = [];

$name = '';
$articleType = '';
$releaseDate = '0000-00-00';
$synopsis = '';
$budget = 0;
$distributorInput = '';
$distributor = '';
$nationalitiesArray = [];
$countriesArray = [];
$artistsArray = [];
$plateformsArray = [];
$artworkGenresArray = [];
$artworkTrailersArray = [];
$distributorc = null;

$articleTypes = new ArticleTypes();
$articleTypesList = $articleTypes->selectArticleTypes();
$distributors = new Distributors();
$distributorsList = $distributors->selectDistributors();
$nationalities = new Nationalities();
$nationalitiesList = $nationalities->selectNationalities();
$countries = new Countries();
$countriesList = $countries->selectCountries();
$artists = new Artists();
$artistsList = $artists->selectArtists();
$plateforms = new Plateforms();
$plateformsList = $plateforms->selectPlateforms();

if(isset($_POST['submitArtwork'])){

    if(!empty($_POST['name'])){
        $name = htmlspecialchars($_POST['name']);
    } else {
        $errorArtworkForm['name'] = 'ERROR_NAME';
    }

    if(!empty($_POST['articleType'])){
        $articleType = htmlspecialchars($_POST['articleType']);
        if(!is_numeric($articleType)){
            $errorArtworkForm['articleType'] = 'ERROR_ARTICLE_TYPE';
        }
    } else {
        $errorArtworkForm['articleType'] = 'ERROR_ARTICLE_TYPE';
    }

    if(!empty($_POST['releaseDate'])){
        $releaseDate = htmlspecialchars($_POST['releaseDate']);
    }

    if(!empty($_POST['synopsis'])){
        $synopsis = htmlspecialchars($_POST['synopsis']);
    }

    if(!empty($_POST['budget'])){
        $budget = htmlspecialchars($_POST['budget']);
    }

    if(!empty($_POST['distributorInput'])){
        $distributorInput = htmlspecialchars($_POST['distributorInput']);
    } else if(!empty($_POST['distributor'])){
        $distributor = htmlspecialchars($_POST['distributor']);
        if(!is_numeric($distributor)){
            $errorArtworkForm['distributor'] = 'ERROR_DISTRIBUTOR';
        }
    } 

    if(!empty($_POST['nationalities'])){
        foreach($_POST['nationalities'] as $nationality){
            if(!is_numeric($nationality)){
                $errorArtworkForm['nationalities'] = 'ERROR_NATIONALITIES';
            } else {
                $nationalitiesArray[] = $nationality;
            }
        }
    } 

    if(!empty($_POST['countries'])){
        foreach($_POST['countries'] as $country){
            if(!is_numeric($country)){
                $errorArtworkForm['countries'] = 'ERROR_COUNTRIES';
            } else {
                $countriesArray[] = $country;
            }
        }
    } 

    if(!empty($_POST['artists'])){
        foreach($_POST['artists'] as $artist){
            if(!is_numeric($artist)){
                $errorArtworkForm['artists'] = 'ERROR_ARTISTS';
            } else {
                $artistsArray[] = $artist;
            }
        }
    }

    if(!empty($_POST['plateforms'])){
        foreach($_POST['plateforms'] as $plateform){
            if(!is_numeric($plateform)){
                $errorArtworkForm['plateforms'] = 'ERROR_PLATEFORMS';
            } else {
                $plateformsArray[] = $plateform;
            }
        }
    } 

    if (!empty($_FILES['image'])) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            if(pathinfo($_FILES['image']['name'])['extension'] == 'png' || pathinfo($_FILES['image']['name'])['extension'] == 'jpg'){
            $image = $_FILES['image'];
            }
        }
    }

    if(count($errorArtworkForm) == 0){
        $newArtwork = new Artworks();
        $newArtwork->name = $name;
        $newArtwork->releaseDate = $releaseDate;
        $newArtwork->synopsis = $synopsis;
        $newArtwork->budget = $budget;
        $newArtwork->id_articleTypes = $articleType;

        $newDistributor = new Distributors();
        $newArtworkNationalities = new AANationalities();
        $newArtworkCountries = new AACountries();
        $newArtworkArtists = new AA();
        $newArtworkTrailers = new Trailers();
        $newArtworkGenres = new ArtworksGenres();
        $newArtworkPlateforms = new ArtworksPlateforms();
        
        try {
            Database::getInstance()->beginTransaction();
            if(!empty($distributorInput)){
                $newDistributor->distributor = $distributorInput;
                $newDistributor->insertDistributor();
                $distributorc = $newDistributor->getLastInsertId();
            } else if(!empty($distributor) && empty($distributorInput)){
                $distributorc = $distributor;
            }
            $newArtwork->id_distributors = $distributorc;
            $newArtwork->insertArtwork();

            $artworkID = $newArtwork->getLastInsertId();

            foreach ($nationalitiesArray as $nationality) {
                $newArtworkNationalities->nationality = $nationality;
                $newArtworkNationalities->artworkID = $artworkID;
                $newArtworkNationalities->insertArtworkNationalities();
            }

            foreach ($countriesArray as $country) {
                $newArtworkCountries->country = $country;
                $newArtworkCountries->artworkID = $artworkID;
                $newArtworkCountries->insertArtworkCountries();
            }

            foreach ($artistsArray as $artist) {
                $newArtworkArtists->artist = $artist;
                $newArtworkArtists->artworkID = $artworkID;
                $newArtworkArtists->insertArtistArtwork();
            }

            foreach ($plateformsArray as $plateform) {
                $newArtworkPlateform->plateform = $plateform;
                $newArtworkPlateform->artworkID = $artworkID;
                $newArtworkPlateform->insertArtworkPlateform();
            }

            foreach ($artworkGenresArray as $artworkGenre) {
                $newArtworkGenre->artworkGenre = $artworkGenre;
                $newArtworkGenre->artworkID = $artworkID;
                $newArtworkGenre->insertArtworkGenre();
            }

            foreach ($artworkTrailersArray as $artworkTrailer) {
                $newArtworkTrailer->artworkTrailer = $artworkTrailer;
                $newArtworkTrailer->artworkID = $artworkID;
                $newArtworkTrailer->insertArtworkTrailer();
            }

            if(isset($image)){
                $first_path = $image['tmp_name'];
                $end_path = '../assets/images/artworks/' .$artworkID;
                move_uploaded_file($first_path, $end_path);
            }
            Database::getInstance()->commit();
        } catch (Exception $e) { // catch error message
            Database::getInstance()->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    } else {
        var_dump($newArtworkPlateform);
    }

}