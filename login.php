<?php
session_start();

if (isset($_SESSION["access_granted"]) && $_SESSION["access_granted"]) {
  header("Location:dashboard.php");
}

$email = "";
if (isset($_SESSION["email_preset"])) {    
  $email = $_SESSION["email_preset"];
}

require_once("header.php");
?>

<div id="login">
<h1>Login</h1>
<form action="login-handler.php" class="login-form"  method ="POST">
  <div class ="form area">
    Username:
    <input placeholder="username here" name="username" class="username-login-input" type="text">
  </div>

  <div class ="form area">
    Password:
    <input name="password" class="password-login-input" type="password">
  </div>

  <div class ="form area">
    <input type="submit" value="Sign In">
  </div>
</form>
</div>

<div id="Sign Up Link">
  <a href="signup.php">SignUp</a> 
</div>


<?php
require_once("footer.php");
?>
