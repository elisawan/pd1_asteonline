<?php
  define('DBUSER', 'root');
  define('DBPASS', '');
  define('DBNAME', 'asteonline');
  define('DBHOST', 'localhost');

  require_once('./include/OBJ_user.php');
  require_once('./include/OBJ_BID.php');
  
  $default_user = new User();
  $default_BID = new BID();
?>
