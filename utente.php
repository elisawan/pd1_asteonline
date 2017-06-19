<?php include "head.html" ?>
<?php include "header_utente.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>

<?php include "protected.php" ?>

<?php
$bid = new BID();
if(!$bid->get()){
    header("Location: ./error_page.php");
    exit;
}
?>

<script type="text/javascript">
    function validateForm() {
        var nuovo_thr = document.forms["aggiorna_thr_form"]["nuovo_thr"].value;
        if ((nuovo_thr == "") ) {
          document.getElementById('msg_errore').innerHTML = "tutti i campi devono essere compilati";
          document.getElementById('msg_errore').style.visibility = "visible";
          return false;
        }
        return true;
    }
</script>
<div class="main">
  <div class="msg_errore"><?php error_message(); ?></div>
  <div class="msg"><?php message(); ?></div>
  <div class="info">
      <p>ciao <span class="user_name"><?php echo $user->get_user_name(); ?></span> </p>
      <p>BID corrente: <span class="bid"><?php  echo $bid->get_BID();?></span> </p>
      <p>effettuata da: <span class="user_name">
          <?php
          if($bid->get_user() == null)
            echo "nessuno ha fatto un offerta...";
        else
          echo $bid->get_user();
          ?></span>
      </p>
  </div>
  <div class="personal">
      <?php
      //var_dump($user->get_THR());
      if(($user->get_THR()) != ""){
          ?>
          <p>THR offerto:<?php echo $user->get_THR()?></p>
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
      } else {
          ?>
          <p>Non hai ancora inserito nessun THR...</p>
          <?php
      }
      ?>

      <?php
      if(($user->get_THR()) != "") echo "Modifica la tua offerta";
      else echo "Fai un offerta";?>
      <form name="aggiorna_thr_form" method="post" action="action_utente.php">
        <input type="hidden" name="form_name" value="aggiorna_thr_form">
        <input type="text" name="nuovo_thr" placeholder="Nuovo valore massimo che sono disposto ad offrire"><br><br>
        <input type="submit" value="Aggiorna"><br/>
      </form>
  </div>

</div>
</div>

<script type="text/javascript">
  var stato = document.getElementById("stato_offerta");
  stato.style.color = "<?php echo $color ?>";
</script>
<script src="display_error.js"></script>
<?php include "footer.html" ?>
