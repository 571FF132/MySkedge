<?php

session_start();
require_once("Dao.php");
$access = new Dao();

if (isset($_POST["loginButton"])){
  $email = $_POST["username"];
  $password = $_POST["password"];

    $access->login($email, $password);  
  } 
}

?>
