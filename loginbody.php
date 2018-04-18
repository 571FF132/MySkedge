<div id="login">
<h1>Login</h1>
<form action="login-handler.php" class="login-form"  method ="POST">
  <div class ="form-area">
    <label for="email">E-mail:</label>
    <input value=<?php echo '"' . $_SESSION['input']['email'] . '"'?> name="email" class="email-login-input" type="text">
  </div>

  <div class ="form-area">
    <label for="password">Password:</label>
    <input name="password" class="password-login-input" type="password">
  </div>

  <div class ="form-area">
    <input name="loginButton" type="submit" value="Sign In">
  </div>
</form>
</div>

<div id="Sign Up Link">
  <h1>New User?</h1> <h2><a href="signup.php">SignUp</a></h2>
</div>
