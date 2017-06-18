<?php

if(!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off')){

}else {
  $redirect = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: '.$redirect);
  exit();
}

my_session_start();
user_logged_in();
$user = $_SESSION['user'];
if(!$user->update_local_values()){
  echo "error: values not updated";
}
?>
