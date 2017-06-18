<?php include "head.html" ?>
<?php include "header_utente.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>
<?php include "protected.php" ?>
<?php
$bid = new BID();
if(!$bid->get()){
    echo "errore";
}
?>
<div class="main">
  <div id="msg_errore"><?php error_message(); ?></div>
  <div id="msg"><?php message(); ?></div>
  <p>ciao <?php echo $user->get_user_name(); ?></p>
  <p>BID corrente: <?php  echo $bid->get_BID();?></p>
  <p>effettuata da: <?php  echo $bid->get_user();?></p>
  <p>THR offerto:<?php echo $user->get_THR();?></p>
  <p>stato offerta:</p>
  <p id="stato_offerta">
        <?php
        if($bid->get_user() === $user->get_user_name()){
          echo "sei il massimo offerente";
          $color = "green";
        }
        else{
          echo "offerta superata";
          $color = "red";
        }
        ?>
  </p>
  <?php
  if(($user->get_THR()) != null) echo "Modifica la tua offerta";
  else echo "Fai un offerta";?>
  <form name="aggiorna_thr_form" method="post" action="action.php">
    <input type="hidden" name="form_name" value="aggiorna_thr_form">
    <input type="text" name="nuovo_thr" required>
    <input type="submit" value="Aggiorna"><br/>
  </form>
</div>
</div>

<script type="text/javascript">
  var stato = document.getElementById("stato_offerta");
  stato.style.color = "<?php echo $color ?>";
</script>
<script src="display_error.js"></script>
<?php include "footer.html" ?>
