<?php
	session_start();
	require_once('Dao.php');
	$dao = new Dao();

	$email = $_POST['email'];
	$password = $_POST['password'];

	$_SESSION['presets'] = array($_POST);
	$valid = true;
  	$messages = array();
  	if (empty($email)) {
    		$messages[] = "Provide an email.";
    		$valid = false;
  	}

  	if (empty($password)) {
    		$messages[] = "Please enter a password.";
    		$valid = false;
  	}

	if (!$valid) {
   		$_SESSION['sentiment'] = "bad";
    		$_SESSION['messages'] = $messages;
    		header("Location: signup.php");
    		exit;
  	}else{
		$_SESSION['sentiment'] = "good";
  		$_SESSION['messages'] = array("Welcome.");
		try{
			$dao->signup($email, $password);
			$_SESSION['access_granted'] = true;
			header("Location: dashboard.php");
			exit;
		} catch (Exception $e) {
			var_dump($e);
      			die;
		}
	}
?>
