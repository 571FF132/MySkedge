<?php

session_start();
require_once("Dao.php");
$access = new Dao();

if (isset($_POST['signupButton'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (isset($_POST['firstname'])) {
		$firstname = $_POST['firstname'];
        }else{
		$firstname = " ";
	}
	if (isset($_POST['lastname'])) {
		$lastname = $_POST['lastname'];
	}else{
                $lastname = " ";
        }
	$_SESSION['input']['email'] = $email;
	$_SESSION['input']['firstname'] = $firstname;
	$_SESSION['input']['lastname'] = $lastname;
  	$access->verifySignup($email, $password, $firstname, $lastname);
	if (isset($_SESSION['verification_fail'])) {
      		header("Location:signup.php");
      		exit;
	} else {
		$access->signup($email, $password, $firstname, $lastname);
		$_SESSION['email'] = $email;
		unset($_SESSION['input']);
		header("Location:dashboard.php");
		exit; 
	}
}
