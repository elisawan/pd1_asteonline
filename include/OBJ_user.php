<?php
/**
 * User
 */
class User
{
  private $thr;
  private $user_name;

  function login($user_name, $password){
    $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if(!$con){
      var_dump(mysqli_connect_errno());
      var_dump(mysqli_connect_error());
      return false;
    }
    var_dump($user_name);
    var_dump($password);
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$user_name."' AND password='".$password."'";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if($result === false)
      return false;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    var_dump($row);
    $this->thr = $row['thr'];
    $this->user_name = $row['user_name'];
    var_dump($this);
    mysqli_free_result($result);
    mysqli_close($con);
    return true;
  }

  function get_for_update($con, $from_user){
    $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if(!$con){
      var_dump(mysqli_connect_errno());
      var_dump(mysqli_connect_error());
      return false;
    }
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$from_user->get_user_name()."' FOR UPDATE";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if($result === false)
      return false;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $this->thr = $row['thr'];
    $this->user_name = $row['user_name'];
    mysqli_free_result($result);
    return true;
  }

  function get($user_name){
    $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$user_name."'";
    $result = mysqli_query($con, $query);
    //var_dump($result);
    if($result === false)
      return false;
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $this->thr = $row['thr'];
    $this->user_name = $row['user_name'];
    mysqli_free_result($result);
    mysqli_close($con);
    return true;
  }



function get_thr(){
  if(isset($this->thr))
    return $this->thr;
  return "nessuna offerta";
}
function set_thr($thr){
  $this->thr = $thr;
  return;
}

function get_user_name(){
  if(isset($this->user_name))
    return $this->user_name;
  return null;
}




function add_user($user_name, $password){
    $user_name=mysql_real_escape_string($user_name);
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $stmt = $con->prepare("INSERT INTO utenti (user_name,password) VALUES (?,?)");
    $stmt->bind_param('ss', $user_name, $password);
    if(!$stmt->execute()){
        $ret = false;
    }else{
        $ret = true;
    }
    $stmt->close();
    $con->close();
    return $ret;
}

function update_thr($con, $thr){
  var_dump($thr);
  echo "---------";
  var_dump($this->get_user_name());
  $query = "UPDATE utenti SET thr = '".$thr."' WHERE user_name = '".$this->get_user_name()."'";
  $result = mysqli_query($con, $query);
  return $result;
}

function update_local_values(){
  $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
  if(!$con){
    var_dump(mysqli_connect_errno());
    var_dump(mysqli_connect_error());
    return false;
  }
  $query = "SELECT user_name, thr FROM utenti WHERE user_name='".$this->user_name."'";
  $result = mysqli_query($con, $query);
  if(!$result)
    return false;
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if(!$row)
    return false;
  $this->user_name = $row['user_name'];
  $this->thr = $row['thr'];
  mysqli_free_result($result);
  mysqli_close($con);
  return true;
}



}





?>
