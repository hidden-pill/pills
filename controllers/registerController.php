<?php

$pseudo = '';
$day = '';
$month = '';
$year = '';
$email = '';
$secretQuestion = '';
$secretAnswer = '';
$newsletter = 0;

$question = new Questions();
$questionsList = $question->selectQuestions();


$formError = [];

if(isset($_POST['submitRegister'])){

    if (!empty($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
    } else {
        $formError['pseudo'] = 'Champs obligatoire.';
    }

    if (!empty($_POST['day'] && $_POST['month'] && $_POST['year'])) {
        $day = htmlspecialchars($_POST['day']);
        $month = htmlspecialchars($_POST['month']);
        $year = htmlspecialchars($_POST['year']);
        $birthDate = $year. '-' .$month. '-' .$day;
    } else {
        $formError['birthDate'] = 'Champs obligatoire.';
    }

    if (!empty($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $formError['password'] = 'Champs obligatoire.';
    }

    if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars($_POST['email']);
    } else {
        $formError['email'] = 'Champs obligatoire.';
    }

    if (!empty($_POST['secretQuestion'])) {
        $secretQuestion = htmlspecialchars($_POST['secretQuestion']);
    } else {
        $formError['secretQuestion'] = 'Champs obligatoire.';
    }

    if (!empty($_POST['secretAnswer'])) {
        $secretAnswer = htmlspecialchars($_POST['secretAnswer']);
    } else {
        $formError['secretAnswer'] = 'Champs obligatoire.';
    }

    if (!empty($_POST['newsletter'])) {
        $newsletter = htmlspecialchars($_POST['newsletter']);
    } else {
        $newsletter = 0;
    }

    // execute if they are no error in array
    if (count($formError) == 0) {
        $user = new Users();
        $user->pseudo = $pseudo;
        $user->birthDate = $birthDate;
        $user->password = $password;
        $user->email = $email;
        $user->secretQuestion = $secretQuestion;
        $user->secretAnswer = $secretAnswer;
        $user->newsletter = $newsletter;
        // if insert didn't work, error message
        if(!$user->userInsert()){
            $message = 0;
        }else{ // else ok message
            $message = 1;
        }
    }
}