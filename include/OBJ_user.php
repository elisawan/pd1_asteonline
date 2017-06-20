<?php
/**
 * User
 */
class User
{
  private $thr;
  private $user_name;

  function get_thr(){
    if(isset($this->thr))
      return $this->thr;
    return "";
  }

  function set_thr($thr){
    $this->thr = $thr;
    return;
  }

  function get_user_name(){
    if(isset($this->user_name))
      return $this->user_name;
    return "";
  }

/* return true if user_name and password are correct, otherwise return false */
  function login($user_name, $password){
    $user_name = mysql_real_escape_string($user_name);
    $password = mysql_real_escape_string($password);
    $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if(!$con){
      //var_dump(mysqli_connect_errno());
      //var_dump(mysqli_connect_error());
      return false; //cannot connect to DB
    }
    //var_dump($user_name);
    //var_dump($password);
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$user_name."' AND password='".$password."'";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if ($result->num_rows != 1)
      return false; //login failed
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == NULL)
      return false;
    //var_dump($row);
    $this->thr = $row['thr'];
    $this->user_name = $row['user_name'];
    //var_dump($this);
    mysqli_free_result($result);
    mysqli_close($con);
    return true; //--> give access to user.php
  }


  function get($from_user){
    $user_name = mysql_real_escape_string($from_user->get_user_name());
    $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if(!$con){
      //var_dump(mysqli_connect_errno());
      //var_dump(mysqli_connect_error());
      return false;
    }
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$user_name."'";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if(!$result)
      return false;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == NULL)
      return false;
    $this->thr = $row['thr'];
    $this->user_name = $row['user_name'];
    mysqli_free_result($result);
    mysqli_close($con);
    return true;
  }

/*before updating thr need to get the lock on the row*/
  function get_for_update($con, $user){
    //var_dump($user_name);
    $user_name = mysql_real_escape_string($user->get_user_name());
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$user_name."' FOR UPDATE";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if(!$result)
      return false;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //var_dump($row);
    if($row == NULL)
      return false;
    $this->thr = $row['thr'];
    $this->user_name = $row['user_name'];
    mysqli_free_result($result);
    return true;
  }



  function add_user($user_name, $password){
      $user_name=mysql_real_escape_string($user_name);
      $password=mysql_real_escape_string($password);
      $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
      if(!$con){
        //var_dump(mysqli_connect_errno());
        //var_dump(mysqli_connect_error());
        return false;
      }
      $result = mysqli_query($con, "INSERT INTO utenti (user_name,password) VALUES ('".$user_name."','".$password."')");
      mysqli_close($con);
      return $result; //true or false
  }

  function update_thr($con, $thr){
    $thr=mysql_real_escape_string($thr);
    //var_dump($thr);
    //echo "---------";
    //var_dump($this->get_user_name());
    $query = "UPDATE utenti SET thr = '".$thr."' WHERE user_name = '".$this->get_user_name()."'";
    $result = mysqli_query($con, $query);
    return $result; //true or false
  }

/*get from the database the updated values, no need for password*/
  function update_local_values(){
    $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if(!$con){
      //var_dump(mysqli_connect_errno());
      //var_dump(mysqli_connect_error());
      return false;
    }
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$this->user_name."'";
    $result = mysqli_query($con, $query);
    if(!$result)
      return false;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($row == NULL)
      return false;
    $this->user_name = $row['user_name'];
    $this->thr = $row['thr'];
    mysqli_free_result($result);
    mysqli_close($con);
    return true;
  }
}
?>
