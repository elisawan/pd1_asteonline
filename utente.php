<?php include "head.html" ?>
<?php include "header_utente.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>
<?php my_session_start(); ?>
<?php user_logged_in();?>


<body>
    <?php if(isset($_GET["message"])){
        echo strip_tags($_GET["message"]);
    }
    ?>
    <?php var_dump($_SESSION); ?>
    <p>ciao <?php echo $_SESSION['user_name']; ?></p>

    <p>BID corrente:
        <?php
        $bid = $default_BID->get_BID();
        if(isset($bid)){
            echo $bid;
        } else {
            echo "errore";
        }
        ?>

    <p>effettuata da:
        <?php
        $winner = $default_BID->get_winner();
        if(isset($winner)){
            echo $winner;
        } else {
            echo "nessuno";
        }
        ?>
    </p>

    <p>THR offerto:
    <?php
    $thr = $default_user->get_THR();
    if(isset($thr)){
        echo($thr);
    } else {
        echo "nessuno";
    }
    ?>
    </p>
    <p>stato offerta:
      <?php
      $is_winner = $default_user->is_winner();
      if(isset($is_winner)){
        if($is_winner)
          echo "sei il massimo offerente";
          else
            echo "offerta superata";

      } else {
          echo "nessuna offerta fatta";
      }
      ?>
    </p>
    <?php
    if(isset($thr)) echo "Modifica la tua offerta";
    else echo "Fai un offerta";?>
    <form name="aggiorna_thr_form" method="post" action="action.php">
      <input type="hidden" name="form_name" value="aggiorna_thr_form">
      <input type="hidden" name="user_name" value=<?php  $_SESSION['user_name']; ?>>
      <input type="text" name="nuovo_thr" required>
      <input type="submit" value="Aggiorna"><br/>
    </form>


</body>



<?php include "footer.html" ?>
