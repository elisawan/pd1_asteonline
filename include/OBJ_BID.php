<?php

/**
 * BID
 */
class BID
{

    function __construct()
    {
        # code...
    }



    function get_BID(){
        $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        $stmt = $con->prepare("SELECT valore FROM BID");
        $stmt->execute();
        $stmt->bind_result($bid);
        while ($stmt->fetch()){
            $res=$bid;
        }
        mysqli_close($con);
        return $res;
    }



    function get_winner(){
        $winner;
        $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        $stmt = $con->prepare("SELECT user_name FROM BID");
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1){
            $stmt->bind_result($winner);
            $stmt->fetch();
        }

        $stmt->close();
        $con->close();
        return $winner;
    }
}





?>
