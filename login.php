<?php
session_start();

if (isset($_SESSION['access_granted']) && $_SESSION['access_granted']) {
  header('Location:dashboard.php');
  exit;
}

require_once('header.php');
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

<?php
require_once('loginbody.php'); 
?>

<?php
require_once('footer.php');
?>
