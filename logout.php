<?php include "functions.php" ?>
<?php my_session_start(); ?>


<?php

  //destroy cookie
  $_SESSION=array();


  // If it's desired to kill the session, also delete the session cookie.
  // Note: This will destroy the session, and not just the session data!
  if (ini_get("session.use_cookies")) {
	  echo "cook";
	  $params = session_get_cookie_params();
	  setcookie(session_name(), '', time() - 3600*24,
		  $params["path"], $params["domain"],
		  $params["secure"], $params["httponly"]
	  );
  }
  session_destroy();  // destroy session
header("location: index.php?message=Logout successful");
?>
