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
            /*
            $artists = new Artists();
            $artists->id_users = $id;
            $artworks = new Artworks();
            $artworks->id_users = $id;
            $comments = new Comments();
            $comments->id_users = $id;
            $upvotes = new Upvotes();
            $upvotes->id_users = $id;
            $reviews = new Reviews();
            $reviews->id_users = $id;
            $reviewsTags = new ReviewsTags();
            $reports = new Reports();
            $reports->id_users = $id;
            $proposals = new Proposals();
            $proposals->id_users = $id;
            $scores = new Scores();
            $scores->id_users = $id;
            $user->id = $id;*/
            try{
                Database::getInstance()->beginTransaction();
                /*updateForDeleteUser('artists', $id);
                updateForDeleteUser('artworks', $id);
                updateForDeleteUser('comments', $id);*/
                $user->deleteForDeleteUser('upvotes');
                /*$reviewsUser = $reviews->searchForDeleteUser();
                foreach($reviewsUser as $review){
                    $reviewsTags->id_reviews = $review;
                    $reviewsTags->deleteForDeleteUser();
                }
                $reviews->deleteForDeleteUser();
                $reports->deleteForDeleteUser();
                $proposals->deleteForDeleteUser();
                $scores->deleteForDeleteUser();
                unlink('../assets/images/users/' .$id);
                $user->deleteUser();
                session_destroy();*/
                echo 'DELETESUCCESS';
                Database::getInstance()->commit();
            } catch (Exception $e) { // catch error message
                Database::getInstance()->rollback();
                die('Erreur : ' . $e->getMessage());
            }


            /*
            if($user->deleteUser()){
                unlink('../assets/images/users/' .$_SESSION['id']);
                session_destroy();
                echo 'DELETESUCCESS';*/
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