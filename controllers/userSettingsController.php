<?php
// check if pseudo params exist in url and if user is connect
if(isset($_GET['pseudo']) && isset( $_SESSION['pseudo'])){
    // if user connect didn't match with user page, redirect to homepage
    if($_GET['pseudo'] != $_SESSION['pseudo']){
        header('Location:/');
        exit;
    }
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $userSettings = $user->selectSettingsUser();
    // change user image
    if(isset($_POST['changeImage'])){
        if(!empty($_FILES['image'])) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                if(pathinfo($_FILES['image']['name'])['extension'] == 'png' || pathinfo($_FILES['image']['name'])['extension'] == 'jpg'){
                    $image = $_FILES['image'];
                    $first_path = $image['tmp_name'];
                    $end_path = '../assets/images/users/' .$_SESSION['id'];
                    move_uploaded_file($first_path, $end_path);
                }
            }
        }
    }

} else { // redirect to homepage if pseudo params didn't exist and/or user not connect
    header('Location:/');
    exit;
}