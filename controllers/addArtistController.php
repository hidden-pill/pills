<?php

$errorArtistForm = [];

$name = '';
$jobsArray = [];
$nationalitiesArray = [];
$countriesArray = [];
$birthDate = '0000-00-00';
$deathDate = '0000-00-00';
$bio = '';

$jobs = new Jobs();
$jobsList = $jobs->selectJobs();
$nationalities = new Nationalities();
$nationalitiesList = $nationalities->selectNationalities();
$countries = new Countries();
$countriesList = $countries->selectCountries();
$culturalObject = new CulturalObjects();
$coList = $culturalObject->selectCulturalObjects();

if(isset($_POST['submitArtist'])){

    if(empty($_POST['name'])){
        $errorArtistForm['name'] = 'ERROR_NAME';
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

    if(!empty($_POST['jobs'])){
        foreach($_POST['jobs'] as $job){
            if(!is_numeric($job)){
                $errorArtistForm['jobs'] = 'ERROR_JOBS';
            } else {
                $jobsArray[] += $job;
            }
        }
    } 

    if(!empty($_POST['nationalities'])){
        foreach($_POST['nationalities'] as $nationality){
            if(!is_numeric($nationality)){
                $errorArtistForm['nationalities'] = 'ERROR_NATIONALITIES';
            } else {
                $nationalitiesArray[] += $nationality;
            }
        }
    } 

    if(!empty($_POST['countries'])){
        foreach($_POST['countries'] as $country){
            if(!is_numeric($country)){
                $errorArtistForm['countries'] = 'ERROR_COUNTRIES';
            } else {
                $countriesArray[] += $country;
            }
        }
    } 
    
    if(!empty($_POST['birthDate'])){
        $birthDate = htmlspecialchars($_POST['birthDate']);
    } 
    
    if(!empty($_POST['deathDate'])){
        $deathDate = htmlspecialchars($_POST['deathDate']);
    }    

    if(!empty($_POST['bio'])){
        $bio = htmlspecialchars($_POST['bio']);
    }

    if (!empty($_FILES['image'])) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $image = $_FILES['image'];
            if(pathinfo($image['name'])['extension'] != 'png'){
                $errorArtistForm['image'] = 'ERROR_IMAGE';
            }
        }
    }
    

    if(count($errorArtistForm) == 10000){
        $newArtist = new Artists();
        $newArtist->name = $name;
        $newArtist->birthDate = $birthDate;
        $newArtist->deathDate = $deathDate;
        $newArtist->bio = $bio;
        $newArtistJobs = new ArtistsJobs();
        $newArtistJobs->jobsArray = $jobsArray;
        $newArtistNationalities = new ACONationalities();
        $newArtistNationalities->nationalitiesArray = $nationalitiesArray;
        $newArtistCountries = new ACOCountries();
        $newArtistCountries->countriesArray = $countriesArray;
        if(1 == 1){
            echo 'raté';
        } else{
            $first_path = $image['tmp_name'];
            $end_path = '../assets/images/artworks/' .$newReview->getLastInsertId(). '.png';
            if (!move_uploaded_file($first_path, $end_path)) {
                echo 'yee';
            }
        }
    }
}