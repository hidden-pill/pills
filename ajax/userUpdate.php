<?php
include_once '../config.php';
if(isset($_SESSION['pseudo'])){
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $userSettings = $user->selectSettingsUser();

    if(isset($_POST['newnewsletter'])){
        $user->newnewsletter = htmlspecialchars($_POST['newnewsletter']);
        if($user->updateNewsletter()){
            echo 'SuccessNewsletter';
        }else{
            echo 'Failed'; 
        }
    }

    if(isset($_POST['checkdelete'])) {
        if($_POST['checkdelete'] == 'SUPPRIMER') {
            if($user->deleteUser()){
                unlink('../assets/images/users/' .$_SESSION['id']);
                session_destroy();
                echo 'DELETESUCCESS';
            }else{
                echo 'Failed'; 
            }
        }
    }
    
    if(isset($_POST['answer'])){
        if($_POST['answer'] == $userSettings->secretAnswer){
            if(isset($_POST['newpassword'])){
                $user->newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                if($user->updatePassword()){
                    echo 'SuccessPassword';
                }else{
                    echo 'Failed'; 
                }
            }

            if(isset($_POST['newemail'])){
                $user->newemail = htmlspecialchars($_POST['newemail']);
                if($user->updateEmail()){
                    echo 'SuccessEmail';
                }else{
                    echo 'Failed'; 
                }
            }

        }else{
            echo 'Failed';
        }
    }
}else{
    echo 'Failed';
}