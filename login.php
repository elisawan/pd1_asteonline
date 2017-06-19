<?php include "head.html" ?>
<?php include "header.html" ?>
<?php include "functions.php" ?>

<script type="text/javascript">
    function validateForm() {
        var email = document.forms["login_form"]["user_name"].value;
        var pass = document.forms["login_form"]["password"].value;
        if ((email == "") ||(pass =="") ) {
          document.getElementById('msg_errore').innerHTML = "tutti i campi devono essere compilati";
          document.getElementById('msg_errore').style.visibility = "visible";
          return false;
        }
        var emailRegExp = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
        if(!emailRegExp.test(email)){
          document.getElementById('msg_errore').innerHTML = "e-mail non valida";
          document.getElementById('msg_errore').style.visibility = "visible";
          return false;
        }
        return true;
    }
</script>
<div class="main">
  <div class="msg_errore"><?php error_message(); ?></div>
  <div class="msg"><?php message(); ?></div>
  <form onsubmit="return validateForm()" name="login_form" method="post" action="action.php" >
    <input type="hidden" name="form_name" value="login_form">
    Username (e-mail): <input name="user_name" type="text" placeholder="Indirizzo e-mail utilizzato durante la registrazione"><br/><br>
    Password: <input name="password" type="password" placeholder="Password scelto durante la registrazione"><br/><br>
    <input type="submit" value="Login"><br/>
  </form>
</div>
</div>

<?php include "footer.html" ?>
