<?php include "head.html" ?>
<?php include "header.html" ?>

<body>
<form name="registration_form" method="post" action="action.php">
  <input type="hidden" name="form_name" value="registration_form">
  Username (e-mail): <input name="user_name" type="email"><br/>
  Password: <input name="password" type="password"><br/>
  Re-type password: <input name="re-password" type="password"><br/>
  <input type="submit" value="Register"><br/>
</form>
</body>



<?php include "footer.html" ?>
