<?php include "head.html" ?>
<?php include "header.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>


<div class="main">
  <div class="msg_errore"><?php error_message(); ?></div>
  <div class="msg"><?php message(); ?></div>
  <?php
  $bid = new BID();
  if(!$bid->get()){
      header("Location: ./error_page.php");
      exit;
  }
  ?>
  <p>BID corrente: <?php  echo $bid->get_BID();?><br>
  <p>effettuata da: <?php  echo $bid->get_user();?></p><br>
</div>
</div>

<?php include "footer.html" ?>
