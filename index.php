<?php include "head.html" ?>
<?php include "header.html" ?>
<?php include "action.php" ?>


<body>
    <?php if(isset($_GET["message"])){
        echo strip_tags($_GET["message"]);
    }
    ?>


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


</body>
<?php include "footer.html" ?>
