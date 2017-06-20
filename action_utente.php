<?php include "config.php" ?>
<?php include "functions.php" ?>
<?php include "protected.php" ?>

<?php


/*
 * Aggiorna thr
 */
if(isset($_POST['form_name']) && $_POST['form_name']=='aggiorna_thr_form'){

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
      //var_dump($bid_update);
      //-----------get user for update with lock , in case the user is using more than one browser at the same tidy_get_html_ver
      $user_update = new User();
      if(!$user_update->get_for_update($con, $_SESSION['user']))
        throw new Exception("user->get_for_update() fallito");
      //var_dump($user_update);
      if($nuovo_thr_val <= $bid_val)
        throw new Exception("valore thr troppo basso, deve essere maggiore del bid corrente");
      if(!$user_update->update_thr($con, $nuovo_thr_val))
        throw new Exception("user->update_thr() fallito");
      //echo "nuovo thr";
      //var_dump($nuovo_thr_val);
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
