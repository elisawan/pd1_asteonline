<?php include "head.html" ?>
<?php include "header_utente.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>

<?php
if(!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off')){

}else {
  $redirect = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: '.$redirect);
  exit();
}
my_session_start();
user_logged_in();
$user = $_SESSION['user'];
if(!$user->update_local_values()){
  echo "error: values not updated";
}
?>

<body>
    <?php if(isset($_GET["message"])){
        echo strip_tags($_GET["message"]);
    }
    ?>

    <p>ciao <?php echo $user->get_user_name(); ?></p>

    <?php
    $bid = new BID();
    if(!$bid->get()){
        echo "errore";
    }
    ?>

    <p>BID corrente: <?php  echo $bid->get_BID();?></p>
    <p>effettuata da: <?php  echo $bid->get_user();?></p>
    <p>THR offerto:<?php echo $user->get_THR();?></p>
    <p>stato offerta:
    <?php
    if($bid->get_user() === $user->get_user_name())
      echo "sei il massimo offerente";
    else
      echo "offerta superata";
    ?>

    </p>
    <?php
    if(isset($thr)) echo "Modifica la tua offerta";
    else echo "Fai un offerta";?>
    <form name="aggiorna_thr_form" method="post" action="action.php">
      <input type="hidden" name="form_name" value="aggiorna_thr_form">
      <input type="text" name="nuovo_thr" required>
      <input type="submit" value="Aggiorna"><br/>
    </form>

</body>

<?php include "footer.html" ?>
