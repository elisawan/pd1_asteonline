<?php include "head.html" ?>
<?php include "header.html" ?>
<?php include "config.php" ?>

<body>
    <?php if(isset($_GET["message"])){
        echo strip_tags($_GET["message"]);
    }
    ?>

    <?php
    $bid = new BID();
    if(!$bid->get()){
        echo "errore";
    }
    ?>

    <p>BID corrente: <?php  echo $bid->get_BID();?>

    <p>effettuata da: <?php  echo $bid->get_user();?>
    </p>


</body>
<?php include "footer.html" ?>
