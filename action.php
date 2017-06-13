<?php require "config.php" ?>
<?php include "functions.php" ?>
<?php my_session_start(); ?>
<?php
/*
 * login
*/
if(isset($_POST['form_name']) && $_POST['form_name']=='login_form'){
    if(!isset($_POST['user_name'])){
      header("location: ./login.php?message=user_name non inserito"); //back to the login page
      exit();
    }
    if(!isset($_POST['password'])){
        header("location: ./login.php?message=password non inserito"); //back to the login page
        exit();
    }
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $current_user = $default_user->get_user($user_name, $password);
    if(isset($current_user)){ //login succeded
        my_session_start();
        $_SESSION['user_name']=$user_name;
        header("location: ./utente.php");
        exit();
    }else{ //login failed
        header("location: ./login.php?message=username e/o password errati"); //back to the login page
        exit();
    }
}

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
        $current_user = $default_user->get_user($_POST['user_name'], $_POST['password']);
    }
    if(isset($current_user)){ //login succeded
        $_SESSION['user_name']=$_POST['user_name'];
        header("location: ./utente.php");
        exit();
    }else{ //login failed
        header("location: ./login.php?message=registrazione non riuscita"); //back to the login page
        exit();
    }
}

/*
 * Aggiorna thr
*/

if(isset($_POST['form_name']) && $_POST['form_name']=='aggiorna_thr_form'){
    if(!isset($_POST['nuovo_thr'])){
      header("location: ./utente.php?message=valore thr non inserito");
      exit();
    }
    $nuovo_thr = strip_tags($_POST['nuovo_thr']);
    if(!($nuovo_thr_val = doubleval($nuovo_thr))){
      header("location: ./utente.php?message=valore thr non valido");
      exit();
    }
    //------$nuovo_thr_val is safe to use------

    $bid = $default_BID->get_BID();
    $bid_val = doubleval($bid);
    if($nuovo_thr_val <= $bid_val){
        header("location: ./utente.php?message=valore thr non valido, inserire un thr maggiore al BID");
        exit();
    }

    if($default_user->update_thr($nuovo_thr_val) == 1){
      $default_BID->update_BID();
      header("location: ./utente.php?message=valore thr aggiornato");
    } else {
      header("location: ./utente.php?message=valore thr non aggiornato");
    }
    exit();
}



?>
