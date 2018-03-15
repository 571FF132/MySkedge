<?php

session_start();

// For simplification Lets pretend I got these login credentials from an SQL table.
if ("123" == $_POST["username"] &&
    "123" == $_POST["password"]) {
  $_SESSION["access_granted"] = true;
  header("Location:granted.php");

} else {
  $status = "Invalid username or password";
  $_SESSION["status"] = $status;
  $_SESSION["email_preset"] = $_POST["username"];
  $_SESSION["access_granted"] = false;

  header("Location:login.php");
}
?>
