<?php

$errorArtistForm = [];

$name = '';
$jobsArray = [];
$nationalitiesArray = [];
$countriesArray = [];
$culturalObjectsArray = [];
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
    } else {
        $errorArtistForm['jobs'] = 'ERROR_JOBS';
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

    if(!empty($_POST['culturalObjects'])){
        foreach($_POST['culturalObjects'] as $culturalObject){
            if(!is_numeric($culturalObject)){
                $errorArtistForm['culturalObjects'] = 'ERROR_CO';
            } else {
                $culturalObjectsArray[] += $culturalObject;
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
    

    if(count($errorArtistForm) == 0){
        $newArtist = new Artists();
        $newArtist->name = $name;
        $newArtist->birthDate = $birthDate;
        $newArtist->deathDate = $deathDate;
        $newArtist->bio = $bio;
        $newArtistJobs = new ArtistsJobs();
        $newArtistNationalities = new ACONationalities();
        $newArtistCountries = new ACOCountries();
        $newArtistCO = new ACO();

        try {
            Database::getInstance()->beginTransaction();
            $newArtist->insertArtist();
            $artistID = $newArtist->getLastInsertId();
            foreach ($jobsArray as $job) {
                $newArtistJobs->job = $job;
                $newArtistJobs->artistID = $artistID;
                $newArtistJobs->insertArtistsJobs();
            }
            foreach ($nationalitiesArray as $nationality) {
                $newArtistNationalities->nationality = $nationality;
                $newArtistNationalities->artistID = $artistID;
                $newArtistNationalities->insertArtistNationalities();
            }
            foreach ($countriesArray as $country) {
                $newArtistCountries->country = $country;
                $newArtistCountries->artistID = $artistID;
                $newArtistCountries->insertArtistCountries();
            }
            foreach ($culturalObjectsArray as $co) {
                $newArtistCO->co = $co;
                $newArtistCO->artistID = $artistID;
                $newArtistCO->insertArtistCO();
            }
            if(isset($image)){
                $first_path = $image['tmp_name'];
                $end_path = '../assets/images/artists/' .$artistID. '.png';
                move_uploaded_file($first_path, $end_path);
            }
            Database::getInstance()->commit();
        } catch (Exception $e) { // catch error message
            Database::getInstance()->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    }
}