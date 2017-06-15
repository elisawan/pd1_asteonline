<?php

/**
 * BID
 */
class BID
{
  private $value;
  private $user;



  function get(){
      $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
      if(!$con){
        var_dump(mysqli_connect_errno());
        var_dump(mysqli_connect_error());
        return false;
      }
      $result = mysqli_query($con, "SELECT valore, user_name FROM BID WHERE num_asta = 1");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $this->value = $row['valore'];
      $this->user = $row['user_name'];
      mysqli_free_result($result);
      mysqli_close($con);
      return true;
  }

  function get_for_update($con){
      $result = mysqli_query($con, "SELECT valore, user_name FROM BID WHERE num_asta = 1 FOR UPDATE");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $this->value = $row['valore'];
      $this->user = $row['user_name'];
      mysqli_free_result($result);
      return true;
  }

  function get_BID(){
      if(isset($this->value))
        return $this->value;
      return null;
  }

  function get_user(){
      if(isset($this->user))
        return $this->user;
      return null;
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

    function update_bid($con){
        $query_first_two = "SELECT thr, user_name FROM utenti ORDER BY thr DESC LIMIT 2 FOR UPDATE";
        $result = mysqli_query($con, $query_first_two);
        if(!$result)
          return false;
        //get max thr and set the user to winner
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $winner_user_name = $row['user_name'];
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "row";
        var_dump($row);
        if(($row) && ($row['thr'] != null)){
          $new_bid = $row['thr'] + 0.01;
        } else {
          $new_bid = 1.01;
        }
        var_dump($new_bid);
        mysqli_free_result($result);

        $query_update_bid = "UPDATE bid SET valore = '".$new_bid."', user_name = '".$winner_user_name."' WHERE  num_asta = 1";
        $result = mysqli_query($con, $query_update_bid);
        if(!$result)
          return false;
        return true;

    }


}





?>
