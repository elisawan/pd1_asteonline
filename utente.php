<?php include "head.html" ?>
<?php include "header_utente.html" ?>
<?php include "config.php" ?>
<?php include "functions.php" ?>
<?php //my_session_start(); ?>
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
            echo $thr;
        } else {
            echo "nessuno";
        }
        ?>
    </p>

</body>



<?php include "footer.html" ?>
