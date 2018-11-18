<?php
include_once '../config.php';
if(isset($_SESSION['pseudo'])){
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $userSettings = $user->selectSettingsUser();

    if(isset($_POST['answer']) && isset($_POST['newpassword'])){
        if($_POST['answer'] == $userSettings->secretAnswer){ 
            $user->newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
            if($user->updatePassword()){
                echo 'Success';
            } else{
                echo 'Failed'; 
            }
        }
        else{
            echo 'Failed';
        }
    }
}else{
    echo 'Failed';
}