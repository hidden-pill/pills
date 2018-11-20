<?php
include_once '../config.php';
if(isset($_SESSION['pseudo'])){
    $id = $_SESSION['id'];
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $user->id = $id;
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
            $reviews = new Reviews();
            $reviewsTags = new ReviewsTags();
            $user->id = $id;
            $reviews->id_users = $id;
            try{
                Database::getInstance()->beginTransaction();
                $user->updateToDeleteUser('comments');
                $user->deleteToDeleteUser('upvotes');
                $user->deleteToDeleteUser('reviews');
                $user->deleteToDeleteUser('reports');
                $user->deleteToDeleteUser('proposals');
                $user->deleteToDeleteUser('scores');
                unlink('../assets/images/users/' .$id);
                $user->deleteUser();
                session_destroy();
                Database::getInstance()->commit();
            } catch (Exception $e) { // catch error message
                Database::getInstance()->rollback();
                die('Erreur : ' . $e->getMessage());
            }
                echo 'DELETESUCCESS';
            }else{
                echo 'Failed'; 
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