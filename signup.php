<?php
require_once("header.php");
?>

<div id="Sign Up">
<h1>Sign Up</h1>
<form action="signup-handler.php" class="login-form"  method ="POST">
  <div class ="form area">
    Username:
    <input placeholder="username here" name="username" class="username-login-input" type="text">
  </div>

  <div class ="form area">
    Password:
    <input name="password" class="password-login-input" type="password">
  </div>

  <div class ="form area">
    <input type="submit" value="Sign Up">
  </div>
</form>
</div>


<?php
require_once("footer.php");
?>

