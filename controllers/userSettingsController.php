<?php
if(isset($_GET['pseudo']) && isset( $_SESSION['pseudo'])){
    if($_GET['pseudo'] != $_SESSION['pseudo']){
        header('Location:/');
        exit;
    }
    $user = new Users();
    $user->pseudo = $_SESSION['pseudo'];
    $userSettings = $user->selectSettingsUser();

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

} else {
    header('Location:/');
    exit;
}