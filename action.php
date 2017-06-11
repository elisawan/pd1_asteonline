<?php require "config.php" ?>

<?php
/*
 * login
*/
if(isset($_POST['form_name']) && $_POST['form_name']=='login_form'){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $current_user = $default_user->get_user($user_name, $password);
    if(isset($current_user)){ //login succeded
        session_start();
        $_SESSION['user_name']=$user_name;
        //echo "utent";
        //echo $_SESSION['user_name'];
        header("location: ./utente.php");
    }else{ //login failed
        header("location: ./login.php?message=username e/o password errati"); //back to the login page
    }
}
?>

<?php
/*
 * Registration
*/

if(isset($_POST['form_name']) && $_POST['form_name']=='registration_form'){
    if($_POST['re-password'] != $_POST['password']){
        header("location: ./registrazione.php?message=le password non combaciano"); //back to the login page
        exit();
    }
    if (!filter_var($_POST['user_name'], FILTER_VALIDATE_EMAIL)) {
        header("location: ./registrazione.php?message=email non valida"); //back to the login page
        exit();
    }
    if($default_user->add_user($_POST['user_name'], $_POST['password'])){
        $current_user = get_user($_POST['user_name'], $_POST['password']);
    }else{

    }
    if(isset($current_user)){ //registration succeded
        header("location: ./utente.php");
    }else{ //registration failed
        header("location: ./registrazione.php?message=registrazione fallita"); //back to the login page
    }
}
?>

<?php

?>
