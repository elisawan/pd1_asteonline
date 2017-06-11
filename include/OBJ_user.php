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
    $stmt->bind_param('s', $user_name);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($thr);
        $stmt->fetch();
    }
    $stmt->close();
    $con->close();
    return $thr;
}

function get_user($user_name, $password){
    $con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $stmt = $con->prepare("SELECT user_name, thr, stato_offerta FROM utenti WHERE user_name=? AND password=?");
    $stmt->bind_param('ss', $user_name, $password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($user_name,$thr,$stato_offerta);
        $stmt->fetch();
        $user=array("user_name"=>$user_name,"thr"=>$thr,"stato_offerta"=>$stato_offerta);
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

}





?>
