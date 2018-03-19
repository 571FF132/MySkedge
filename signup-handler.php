<?php
	session_start();
	require_once("Dao.php");
	$dao = new Dao();

	$name = $_POST["username"];
	$password = $_POST["password"];

	$_SESSION['presets'] = array($_POST);
	$valid = true;
  	$messages = array();
  	if (empty($name)) {
    		$messages[] = "PLEASE ENTER A NAME";
    		$valid = false;
  	}

  	if (empty($password)) {
    		$messages[] = "PLEASE ENTER A PASSWORD.";
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
			$dao->signup($name, $password);
			header("Location: dashboard.php");
			exit;
		} catch (Exception $e) {
			var_dump($e);
      			die;
		}
	}
?>
