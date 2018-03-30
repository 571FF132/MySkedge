<?php
session_start();

if (isset($_SESSION['access_granted']) && !$_SESSION['access_granted']
     || !isset($_SESSION['access_granted'])) {
      
      $_SESSION['sentiment'] = "bad";
      $_SESSION['messages'][0] = "Don't do that, bro. Login first.";
      header("Location:login.php");
      exit;
}
require_once('header.php');



require_once('dashboardbody.php');

require_once('footer.php');
?>

