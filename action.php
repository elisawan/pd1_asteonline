<?php require "config.php" ?>
<?php include "functions.php" ?>
<?php
/*
 * login
*/
if(isset($_POST['form_name']) && $_POST['form_name']=='login_form'){
    if(!isset($_POST['user_name'])){
      header("location: ./login.php?msg_errore=user_name non inserito"); //back to the login page
      exit();
    }
    if(!isset($_POST['password'])){
        header("location: ./login.php?msg_errore=password non inserito"); //back to the login page
        exit();
    }
    $user_name = strip_tags($_POST['user_name']);
    $password = md5($_POST['password']);
    $user = new User();
    if(!$user->login($user_name, $password)){ //login failed
      header("location: ./login.php?msg_errore=username e/o password errati"); //back to the login page
      exit();
    }
    my_session_start();
    $_SESSION['time']=time();
    $_SESSION['user']=$user;
    //var_dump($_SESSION['user']);
    header("location: ./utente.php");
    exit();

}

/*
 * Registration
*/
if(isset($_POST['form_name']) && $_POST['form_name']=='registration_form'){
    if($_POST['re-password'] != $_POST['password']){
        header("location: ./registrazione.php?msg_errore=le password non combaciano"); //back to the login page
        exit();
    }
    if (!filter_var($_POST['user_name'], FILTER_VALIDATE_EMAIL)) {
        header("location: ./registrazione.php?msg_errore=email non valida"); //back to the login page
        exit();
    }
    if(!(preg_match("/[a-z]/i", $_POST['password']) && preg_match("/\\d/", $_POST['password']))){
      header("location: ./registrazione.php?msg_errore=pass non valida"); //back to the login page
      exit();
    }
    $user = new User();
    if($user->add_user($_POST['user_name'], md5($_POST['password']))){
      header("location: ./index.php?msg=registrazione effettuata con successo");
      exit();
    }
    header("location: ./login.php?msg_errore=registrazione non riuscita"); //back to the login page
    exit();
}




?>
