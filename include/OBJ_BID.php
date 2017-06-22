<?php

/**
 * BID
 */
class BID
{
  private $value;
  private $user;


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


/*get from DB*/
  function get(){
      $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
      //var_dump($con);
      if(!$con)
        return false;
      $result = mysqli_query($con, "SELECT valore, user_name FROM bid WHERE num_asta = 1");
      if((!$result) || (mysqli_num_rows($result) != 1))
        return false;
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if($row == null)
        return false;
      $this->value = $row['valore'];
      if($row['user_name'] == "")
        $this->user = "Nessuno";
      else
        $this->user = $row['user_name'];
      mysqli_free_result($result);
      mysqli_close($con);
      return true;
  }

/*get from DB with lock before update*/
  function get_for_update($con){
      $result = mysqli_query($con, "SELECT valore, user_name FROM bid WHERE num_asta = 1 FOR UPDATE");
      if((!$result) || (mysqli_num_rows($result) != 1))
        return false;
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if($row == null)
        return false;
      $this->value = $row['valore'];
      $this->user = $row['user_name'];
      mysqli_free_result($result);
      return true;
  }

/*update the value everytime a user offer a new thr*/
  function update_bid($con){
      $query_first_two = "SELECT thr, user_name FROM utenti ORDER BY thr DESC LIMIT 2 FOR UPDATE";
      $result = mysqli_query($con, $query_first_two);
      if(!$result)
        return false;
      //get max thr and set the user to winner
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if($row == null)
        return false;
      $winner_user_name = $row['user_name'];
      $thr_max = $row['thr'];
      //get the second highest thr
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if(($row != NULL) && ($row['thr'] != null)){ //there is a second thr
        $thr_second = $row['thr'];
        if($thr_max === $thr_second){
          $new_bid = $thr_max;
          $winner_user_name = $this->user;
        }
        else
          $new_bid = $thr_second + 0.01;
      } else { //there are no other thr, only one thr offered
        $new_bid = 1.00;
      }
      //var_dump($new_bid);
      mysqli_free_result($result);

      $query_update_bid = "UPDATE bid SET valore = '".$new_bid."', user_name = '".$winner_user_name."' WHERE  num_asta = 1";
      $result = mysqli_query($con, $query_update_bid);
      return $result; //true or false
  }
}

?>
