<?php
//include config to get session and all models
include_once '../config.php';

//check if user is connect
if(isset($_SESSION['pseudo'])){
    $id = $_SESSION['id'];
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $user->id = $id;
    $userSettings = $user->selectSettingsUser();

    //if user want to change status of newsletter
    if(isset($_POST['newnewsletter'])){
        $user->newnewsletter = htmlspecialchars($_POST['newnewsletter']);
        if($user->updateNewsletter()){
            // send success to js file
            echo 'SuccessNewsletter';
        }else{
            // send error to js file
            echo 'Failed'; 
        }
    }

    //if user want to delete his account
    if(isset($_POST['checkdelete'])) {
        // check if user is not drunk
        if($_POST['checkdelete'] == 'SUPPRIMER') {
            // TRANSACTION /!\
            try{
                // start
                Database::getInstance()->beginTransaction();
                // gave comment to an anon account
                $user->updateToDeleteUser('comments');
                $user->deleteToDeleteUser('upvotes');
                $user->deleteToDeleteUser('reviews');
                $user->deleteToDeleteUser('reports');
                $user->deleteToDeleteUser('proposals');
                $user->deleteToDeleteUser('scores');
                unlink('../assets/images/users/' .$id);
                $user->deleteUser();
                session_destroy();
                //end
                Database::getInstance()->commit();
            } catch (Exception $e) { // catch error message
                Database::getInstance()->rollback();
                die('Erreur : ' . $e->getMessage());
            }
            // send success to js file
                echo 'DELETESUCCESS';
            }else{
            // send error to js file
                echo 'Failed'; 
            }
        }
    
    // check if input for secret answer is set
    if(isset($_POST['answer'])){
        // check if its same in db
        if($_POST['answer'] == $userSettings->secretAnswer){
            // if user want to change password
            if(isset($_POST['newpassword'])){
                // send a new password hashed
                $user->newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                if($user->updatePassword()){
                    // send success to js file
                    echo 'SuccessPassword';
                }else{
                    // send error to js file
                    echo 'Failed'; 
                }
            }

            // if user want to change email
            if(isset($_POST['newemail'])){
                $user->newemail = htmlspecialchars($_POST['newemail']);
                if($user->updateEmail()){
                    // send success to js file
                    echo 'SuccessEmail';
                }else{
                    // send error to js file
                    echo 'Failed'; 
                }
            }

        }else{
            // send error to js file
            echo 'Failed';
        }
    }
}else{
    // send error to js file
    echo 'Failed';
}