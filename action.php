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

/*
 * Aggiorna thr
*/
if(isset($_POST['form_name']) && $_POST['form_name']=='aggiorna_thr_form'){
    my_session_start();
    user_logged_in();
    if(!isset($_POST['nuovo_thr'])){
      header("location: ./utente.php?msg_errore=valore thr non inserito");
      exit();
    }
    $nuovo_thr = strip_tags($_POST['nuovo_thr']);
    if(!($nuovo_thr_val = doubleval($nuovo_thr))){
      header("location: ./utente.php?msg_errore=valore thr non valido");
      exit();
    }
    //------$nuovo_thr_val is safe to use------
    //-----transazione per update thr e bid----
    try{
      $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
      if(!$con){
        throw new Exception("connessione fallita");
      }
      mysqli_autocommit($con, false);

      //--------get current value of bid with lock for update----
      $bid_update = new BID();
      if(!$bid_update->get_for_update($con))
        throw new Exception("bid->get_for_update() fallito");
      $bid_val = doubleval($bid_update->get_BID());
      var_dump($bid_update);
      //-----------get user for update with lock , in case the user is using more than one browser at the same tidy_get_html_ver
      $user_update = new User();
      if(!$user_update->get_for_update($con, $_SESSION['user']))
        throw new Exception("user->get_for_update() fallito");
      var_dump($user_update);
      if($nuovo_thr_val <= $bid_val)
        throw new Exception("valore thr troppo basso, deve essere maggiore del bid corrente");
      if(!$user_update->update_thr($con, $nuovo_thr_val))
        throw new Exception("user->update_thr() fallito");
      echo "nuovo thr";
      var_dump($nuovo_thr_val);
      if(!$bid_update->update_bid($con))
        throw new Exception("bid->update() fallito");
    }
    catch(Exception $e){
      mysqli_rollback($con);
      echo $e->getMessage();
      mysqli_commit($con);
      mysqli_close($con);
      header("location: ./utente.php?msg_errore=update thr fallito:".$e->getMessage());
      exit();
    }
    mysqli_commit($con);
    mysqli_close($con);
    header("location: ./utente.php?msg=update eseguito con successo");
    exit();
}



?>
