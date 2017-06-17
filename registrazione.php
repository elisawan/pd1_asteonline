<?php include "head.html" ?>
<?php include "header.html" ?>
<script type="text/javascript">
function validateForm() {
    var email = document.forms["registration_form"]["user_name"].value;
    var pass1 = document.forms["registration_form"]["password"].value;
    var pass2 = document.forms["registration_form"]["re-password"].value;
    if ((email == "") ||(pass1 =="") ||(pass2=="")) {
      document.getElementById('msg_errore').innerHTML = "tutti i campi devono essere compilati";
      return false;
    }
    var emailRegExp = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
    if(!emailRegExp.test(email)){
      document.getElementById('msg_errore').innerHTML = "e-mail non valida";
      return false;
    }
    var passRegExp = /[a-zA-Z]+[0-9]+|[0-9]+[a-zA-Z]+/;
    if(!passRegExp.test(pass1)){
      document.getElementById('msg_errore').innerHTML = "password non valida: deve contenere almeno un carattere alfabetico ed un numero";
      return false;
    }
    if(pass1!=pass2){
      document.getElementById('msg_errore').innerHTML = "le password non combaciano";
      return false;
    }
    return true;
}
</script>

<body>
  <p id="msg_errore"></p>
  <form name="registration_form" method="post" action="action.php" onsubmit="return validateForm();">
    <input type="hidden" name="form_name" value="registration_form">
    Username (e-mail): <input name="user_name" type="text"><br/>
    Password: <input name="password" type="password"><br/>
    Re-type password: <input name="re-password" type="password"><br/>
    <input type="submit" value="Register"><br/>
  </form>
</body>



<?php include "footer.html" ?>
