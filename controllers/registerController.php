<?php

$formError = [];

if (isset($_POST['submitRegister'])) {

    if (!empty($_POST['pseudo'])) {
        $pseudo = htmlspecialchars(ucwords(strtolower($_POST['pseudo'])));
        if (preg_match(Regex::PSEUDO, $pseudo)) {
            $formError['pseudo'] = ERROR_REGEX_PSEUDO;            
        }
    } else {
        $formError['pseudo'] = ERROR_EMPTY_PSEUDO;
    }

    if (!empty($_POST['email'])) {
        $email = htmlspecialchars(strtolower($_POST['email'])));
        if (!FILTER_VAR($mail, FILTER_VALIDATE_EMAIL)) {
            $formError['email'] = ERROR_FILTER_EMAIL;            
        }
    } else {
        $formError['email'] = ERROR_EMPTY_EMAIL;
    }

    if (!empty($_POST['password']) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $errorList['password'] = ERROR_EMPTY_PASSWORD;
    }

    if (!empty($_POST['secretQuestion'])) {
        $secretQuestion = htmlspecialchars($_POST['secretQuestion']));
        if (is_nan($secretQuestion)) {
            $formError['secretQuestion'] = ERROR_NAN_SECRETQUESTION;       
        }
    } else {
        $formError['secretQuestion'] = ERROR_EMPTY_SECRETQUESTION;
    }








    if (count($formError) == 0) {
        $user->birthDate = $year . '-' . $month . '-' . $day;
        $checkUser = $user->checkIfUsersExist();
        $checkSecretQuestion = $user->checkifSecretQuestionExist();
        if($checkSecretQuestion === '0'){
            if ($checkUser === '0') {
                if (!$user->addUser()) {
                    $formError['submit'] = ERROR_SUBMIT_SQL;
                }
            } elseif ($check === FALSE) {
                $formError['submit'] = ERROR_SUBMIT_SQL;
            }
            else {
                $formError['submit'] = ERROR_SUBMIT_ALLREADY_EXISTS;
            }
        }
    }

}