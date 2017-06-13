<?php
/**
 * User
 */
class User
{

function get_THR(){

    $thr = NULL;
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $con->prepare("SELECT thr FROM utenti WHERE user_name=?");
    $stmt->bind_param('s', $_SESSION['user_name']);
    if(!$stmt->execute()){
        return false;
    }
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($thr);
        $stmt->fetch();
    }
    $stmt->close();
    $con->close();
    return $thr;
}

function is_winner(){

    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $con->prepare("SELECT is_winner FROM utenti WHERE user_name=?");
    $stmt->bind_param('s', $_SESSION['user_name']);
    if(!$stmt->execute()){
        return false;
    }
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($is_winner);
        $stmt->fetch();
    }
    $stmt->close();
    $con->close();
    return $is_winner;
}

function get_user($user_name, $password){
    $user = null;
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $stmt = $con->prepare("SELECT user_name, thr, is_winner FROM utenti WHERE user_name=? AND password=?");
    $stmt->bind_param('ss', $user_name, $password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($user_name,$thr,$is_winner);
        $stmt->fetch();
        $user=array("user_name"=>$user_name,"thr"=>$thr,"is_winner"=>$is_winner);
    }
    $stmt->close();
    $con->close();

    return $user;

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

function update_thr($thr){
    if(func_num_args() != 1){
        return FALSE;
    }
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        return FALSE;
    }
    $stmt = $con->prepare("UPDATE utenti SET thr = ? WHERE user_name = ?");
    $stmt->bind_param('ds', $thr, $_SESSION['user_name']);
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
