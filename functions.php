<?php

function error_message(){
  if(isset($_GET["msg_errore"])){
      echo htmlentities($_GET["msg_errore"]);
  }
}

function message(){
  if(isset($_GET["msg"])){
      echo htmlentities($_GET["msg"]);
  }
}

function user_logged_in() {
    if (!isset($_SESSION['user']))
        header("Location: login.php?msg_errore=accesso negato");
}

function my_session_start(){
    session_start();
    $t=time();
    $diff=0;
    $new=false;
    if (isset($_SESSION['time'])){
        $t0=$_SESSION['time'];
        $diff=($t-$t0);  // inactivity period
    } else {
        $new=true;
    }
    if ($diff > 120) { // new or with inactivity period too long
        $_SESSION=array();
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 3600*24,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();  // destroy session
        // redirect client to login page
        header('HTTP/1.1 307 temporary redirect');
        header('Location: login.php?msg_errore=SessionTimeOut');
        exit; // IMPORTANT to avoid further output from the script
    } elseif($new){
        $_SESSION=array();
    } else {
        $_SESSION['time']=time(); /* update time */
    }
}


function my_session_end() {
   $_SESSION=array();
   if (ini_get("session.use_cookies")) {
       $params = session_get_cookie_params();
       setcookie(session_name(), '', time()-3600*24,
           $params["path"],$params["domain"],
           $params["secure"], $params["httponly"]);
   }
   session_destroy(); // destroy session
}
?>
