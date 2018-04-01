<?php
session_start();

require_once("header.php");
?>

<?php
     if (isset($_SESSION['messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['messages'] as $message) {
         echo "<div class='message $sentiment'>$message</div>";
         unset($message);
       }
     }
?>

<div id="Sign Up">
<h1>Sign Up</h1>
* = required.
<form action="signup-handler2.php" class="login-form"  method ="POST">
  <div class ="form-area">
    Email:
    <input value=<?php echo '"' . $_SESSION['input']['email'] . '"'?> placeholder="email here" name="email" class="login-input" type="text"> *
  </div>
  
  <div class ="form-area">
    Password:
    <input name="password" class="login-input" type="password"> *
  </div>

  <div class ="form-area">
    First Name:
    <input value=<?php echo '"' . $_SESSION['input']['firstname'] . '"'?> placeholder="First name" name="firstname" class="login-input" type="text">
  </div>

  <div class ="form-area">
    Last Name:
    <input value=<?php echo '"' . $_SESSION['input']['lastname'] . '"'?> placeholder="Last name" name="last name" class="login-input" type="text">
  </div>

  <div class ="form-area">
    <input name="signupButton" type="submit" value="Sign Up">
  </div>
</form>
</div>


<?php
require_once("footer.php");
?>

