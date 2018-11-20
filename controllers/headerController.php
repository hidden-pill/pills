<?php

$identifier = '';
$errorList = array();
$message='';

if(isset($_POST['submitLogin'])){
    if (!empty($_POST['identifier'])) {
        $identifier = htmlspecialchars($_POST['identifier']);
    }else{
        $errorList['identifier'] = 'ERROR_LOGIN';
    }

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    }else{
        $errorList['password'] = 'ERROR_LOGIN';
    }

    if(count($errorList) == 0){
        $user = new Users();
        $user->identifier = $identifier;
        if($user->userConnection()){
            if(password_verify($password, $user->password)){
                //la connexion se fait
                $message = 'USER_CONNECTION_SUCCESS';
                //On rempli la session avec les attributs de l'objet issus de l'hydratation
                $_SESSION['pseudo'] = $user->pseudo;
                $_SESSION['id'] = $user->id;
                $_SESSION['rank'] = $user->id_ranks;
                $_SESSION['isConnect'] = true;
            }else{
                //la connexion échoue
                $message = 'USER_CONNECTION_ERROR';
            }
        }
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'disconnect') {
        session_destroy();
        header('location:' .$path. 'index.php');
    }
}