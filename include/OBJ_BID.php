<?php

/**
 * BID
 */
class BID
{
    function get_BID(){
        $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

        $stmt = $con->prepare("SELECT valore FROM BID WHERE num_asta = 1");
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

    function update_BID(){
        $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        $stmt = $con->prepare("SELECT thr, user_name FROM utenti ORDER BY thr DESC LIMIT 2");
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($thr, $user_name);
        //get max thr and set the user to winner
        $stmt->fetch();
        $winner = $user_name;
        $stmt = $con->prepare("UPDATE utenti SET is_winner = ? WHERE user_name = ?");
        echo "----------";
        echo $winner;
        $is_winner = true;
        $stmt->bind_param('is', $is_winner, $winner);
        if(!$stmt->execute()){
            $ret = false;
        }else{
            $ret = true;
        }
        //change bid value
        $stmt->fetch();
        $new_bid = $thr + 0.01; //thr = second
        $stmt->close();

        $stmt = $con->prepare("UPDATE bid SET valore = ?, user_name = ? WHERE  num_asta = 1");
        $stmt->bind_param('ds', $new_bid, $winner);
        if(!$stmt->execute()){
            $ret = false;
        }else{
            $ret = true;
        }
        $stmt->close();
        $con->close();
        return $ret;

    }


}





?>
