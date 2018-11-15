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
                $nationalitiesArray[] += $nationality;
            }
        }
    } 

    if(!empty($_POST['countries'])){
        foreach($_POST['countries'] as $country){
            if(!is_numeric($country)){
                $errorArtworkForm['countries'] = 'ERROR_COUNTRIES';
            } else {
                $countriesArray[] += $country;
            }
        }
    } 

    if(!empty($_POST['artists'])){
        foreach($_POST['artists'] as $artist){
            if(!is_numeric($artist)){
                $errorArtworkForm['artists'] = 'ERROR_ARTISTS';
            } else {
                $artistsArray[] += $artist;
            }
        }
    }

    if(!empty($_POST['plateforms'])){
        foreach($_POST['plateforms'] as $plateform){
            if(!is_numeric($plateform)){
                $errorArtworkForm['plateforms'] = 'ERROR_PLATEFORMS';
            } else {
                $plateformsArray[] += $plateform;
            }
        }
    } 

    if(count($errorArtworkForm) == 10000){
        $newArtwork = new Artworks();
        $newArtwork->name = $name;


    }
}