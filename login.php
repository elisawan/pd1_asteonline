<?php include "head.html" ?>
<?php include "header.html" ?>

<body>
<form name="login_form" method="post" action="action.php">
  <input type="hidden" name="form_name" value="login_form">
  Username (e-mail): <input name="user_name" type="email" required><br/>
  Password: <input name="password" type="password" required><br/>
  <input type="submit" value="Login"><br/>
</form>
</body>



<?php include "footer.html" ?>
