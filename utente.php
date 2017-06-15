<?php include "head.html" ?>
<?php include "header_utente.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>

<?php include "protected.php" ?>

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
    if(($user->get_THR()) != null) echo "Modifica la tua offerta";
    else echo "Fai un offerta";?>
    <form name="aggiorna_thr_form" method="post" action="action.php">
      <input type="hidden" name="form_name" value="aggiorna_thr_form">
      <input type="text" name="nuovo_thr" required>
      <input type="submit" value="Aggiorna"><br/>
    </form>

</body>

<?php include "footer.html" ?>
