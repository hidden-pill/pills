<?php
// initialize variables / arrays
$errorArtistForm = [];
$name = '';
$jobsArray = [];
$nationalitiesArray = [];
$countriesArray = [];
$artworksArray = [];
$birthDate = '0000-00-00';
$deathDate = '0000-00-00';
$bio = '';

// all instances for all selectors
$jobs = new Jobs();
$jobsList = $jobs->selectJobs();
$nationalities = new Nationalities();
$nationalitiesList = $nationalities->selectNationalities();
$countries = new Countries();
$countriesList = $countries->selectCountries();
$artwork = new Artworks();
$artworksList = $artwork->selectArtworks();


// submit artist
if(isset($_POST['submitArtist'])){

    if(empty($_POST['name'])){
        $errorArtistForm['name'] = 'ERROR_NAME';
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

    // clean all contents in jobs array
    if(!empty($_POST['jobs'])){
        foreach($_POST['jobs'] as $job){
            if(!is_numeric($job)){
                $errorArtistForm['jobs'] = 'ERROR_JOBS';
            } else {
                $jobsArray[] = $job;
            }
        }
    } else {
        $errorArtistForm['jobs'] = 'ERROR_JOBS';
    }

    // clean all contents in nationalities array
    if(!empty($_POST['nationalities'])){
        foreach($_POST['nationalities'] as $nationality){
            if(!is_numeric($nationality)){
                $errorArtistForm['nationalities'] = 'ERROR_NATIONALITIES';
            } else {
                $nationalitiesArray[] = $nationality;
            }
        }
    } 

    // clean all contents in countries array
    if(!empty($_POST['countries'])){
        foreach($_POST['countries'] as $country){
            if(!is_numeric($country)){
                $errorArtistForm['countries'] = 'ERROR_COUNTRIES';
            } else {
                $countriesArray[] = $country;
            }
        }
    } 

    // clean all contents in artworks array
    if(!empty($_POST['artworks'])){
        foreach($_POST['artworks'] as $artwork){
            if(!is_numeric($artwork)){
                $errorArtistForm['artworks'] = 'ERROR_ARTWORKS';
            } else {
                $artworksArray[] = $artwork;
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

    // if image exists, upload it only if extension if jpg and png
    if (!empty($_FILES['image'])) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            if(pathinfo($_FILES['image']['name'])['extension'] == 'png' || pathinfo($_FILES['image']['name'])['extension'] == 'jpg'){
                $image = $_FILES['image'];
            } else {
                $errorArtistForm['image'] = 'ERROR_IMAGE';
            }
        }
    }
    
    // try to insert in db if error array still empty after all tests
    if(count($errorArtistForm) == 0){
        $newArtist = new Artists();
        $newArtist->name = $name;
        $newArtist->birthDate = $birthDate;
        $newArtist->deathDate = $deathDate;
        $newArtist->bio = $bio;
        $newArtistJobs = new ArtistsJobs();
        $newArtistNationalities = new AANationalities();
        $newArtistCountries = new AACountries();
        $newArtistArtwork = new AA();

        // transaction
        try {
            //start
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
            foreach ($artworksArray as $artwork) {
                $newArtistArtwork->artwork = $artwork;
                $newArtistArtwork->artistID = $artistID;
                $newArtistArtwork->insertArtistArtwork();
            }
            if(isset($image)){
                $first_path = $image['tmp_name'];
                $end_path = '../assets/images/artists/' .$artistID;
                move_uploaded_file($first_path, $end_path);
            }
            // execute all insert if there is no problems
            Database::getInstance()->commit();
        } catch (Exception $e) { // catch error message
            Database::getInstance()->rollback();
            die('Erreur : ' . $e->getMessage());
        }
    } else {
        var_dump($errorArtistForm);
    }
}