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
       unset($_SESSION['messages']);
     }
?>

<div id="Sign Up">
<h1>Sign Up</h1>
* = required.
<form action="signup-handler2.php" class="login-form"  method ="POST">
  <div class ="form-area">
    <label for="email">Email:</label>
    <input value=<?php echo '"' . $_SESSION['input']['email'] . '"'?> placeholder="email here" name="email" class="login-input" type="text"> *
  </div>
  
  <div class ="form-area">
    <label for="Password">Password:</label>
    <input name="password" class="login-input" type="password"> *
  </div>

  <div class ="form-area">
    <label for="firstname">First Name:</label>
    <input value=<?php echo '"' . $_SESSION['input']['firstname'] . '"'?> placeholder="First name" name="firstname" class="login-input" type="text">
  </div>

  <div class ="form-area">
    <label for"lastname">Last Name:</label>
    <input value=<?php echo '"' . $_SESSION['input']['lastname'] . '"'?> placeholder="Last name" name="lastname" class="login-input" type="text">
  </div>

  <div class ="form-area">
    <input name="signupButton" type="submit" value="Sign Up">
  </div>
</form>
</div>


<?php
require_once("footer.php");
?>

