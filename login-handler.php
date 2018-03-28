<?php

session_start();
require_once("Dao.php");


/*if (!isset($_POST[])){
  $_SESSION["] = $status;
}*/

$messages = array();
$User = array();
if (isset($_POST["loginButton"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  try {
    $dao = new Dao();
    $User = $dao->login($username, $password);
    if ($User["rcdID"] != null){ 
      $_SESSION["access_granted"] = true;
      $_SESSION["RID"] = $User["rcdID"];
      $_SESSION['sentiment'] = "good";

      header("Location: dashboard.php");
      exit;
    }else{
      $_SESSION["access_granted"] = false;
      $_SESSION['sentiment'] = "bad";
      $messages[] = "UserID did equal null?" . $User["rcdID"];
      print_r($User);
      print("\n");
      $_SESSION['messages'] = $messages;
      header("Location: login.php");
      exit;
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
