<?php
session_start();

if (isset($_SESSION['access_granted']) && $_SESSION['access_granted']) {
  header('Location:dashboard.php');
  exit;
}

/*$email = "";
if (isset($_SESSION["email_preset"])) {    
  $email = $_SESSION["email_preset"];
}*/

require_once("header.php");
?>

<?php
     if (isset($_SESSION['messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['messages'] as $message) {
         echo "<div class='message $sentiment'>$message</div>";
         unset($_SESSION['messages']);
       }
     }
     ?>

<?php
require_once("loginbody.php"); 
?>

<?php
require_once("footer.php");
?>
