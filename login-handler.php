<?php

session_start();
require_once("Dao.php");


/*if (!isset($_POST[])){
  $_SESSION["] = $status;
}*/


if (isset($_POST["loginButton"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  try {
    $dao = new Dao();
    $User = $dao->login($username, $password);
    if ($User["ID"] != null){ 
      $_SESSION["access_granted"] = true;
      header("Location:dashboard.php");
    }
     
  } catch (Exception $e){
    var_dump($e);
    die;
  } 
}


/*
// For simplification Lets pretend I got these login credentials from an SQL table.
if ("123" == $_POST["username"] &&
    "123" == $_POST["password"]) {
  $_SESSION["access_granted"] = true;
  header("Location:dashboard.php");

} else {
  $status = "Invalid username or password";
  $_SESSION["status"] = $status;
  $_SESSION["email_preset"] = $_POST["username"];
  $_SESSION["access_granted"] = false;

  header("Location:login.php");
}*/
?>
