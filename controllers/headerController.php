<?php
/* header controller
 also used to user connection
in the entire website */

$identifier = '';
$errorList = array();
$message='';

// user try to connect
if(isset($_POST['submitLogin'])){
    // check if inputs are not empty

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

    // if there is no error, try connection
    if(count($errorList) == 0){
        $user = new Users();
        $user->identifier = $identifier;
        if($user->userConnection()){
            // check if password match
            if(password_verify($password, $user->password)){
                //la connexion se fait
                $message = 'USER_CONNECTION_SUCCESS';
                // set session
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

// disconnect part
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'disconnect') {
        session_destroy();
        header('location:' .$path. 'index.php');
    }
}