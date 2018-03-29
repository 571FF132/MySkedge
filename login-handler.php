<?php

session_start();
require_once("Dao.php");
$access = new Dao();

if (isset($_POST["loginButton"])){
  $username = $_POST["username"];
  $password = $_POST["password"];

  try {
    $access->login($username, $password);
     
  } catch (Exception $e){
    var_dump($e);
    die;
    exit;
  } 
}

?>
