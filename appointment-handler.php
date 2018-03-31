<?php
        session_start();
        require_once('Dao.php');
        $dao = new Dao();

        $CXID = $_SESSION['RID'];
        $BXID = $_POST['business-select'];
        $EMPID = $_POST['employee-select'];
        $apptstartdate = $_POST['appointment-start-date'];
	$apptstarttime = $_POST['appointment-start-time'];
	$apptenddate = $_POST['appointment-end-date'];
        $apptendtime = $_POST['appointment-end-time'];
        $apptstart = DateTime::createFromFormat('Y-m-d H:i:s', $apptstartdate . $apptstarttime);
	$apptend = DateTime::createFromFormat('Y-m-d H:i:s', $apptenddate . $apptendtime);
        $_SESSION['presets'] = array($_POST);
        $valid = true;
        $messages = array();
        if ($BXID = 0) {
                $messages[] = "Please select a Business.";
                $valid = false;
        }

        if ($CXID = 0) {
                $messages[] = "Something went wrong. Please contact webmaster.";
                $valid = false;
        }
	if ($apptstart > $apptend) {
		$messages[] = "You can not have an appointment end before it starts, dude.";
		$valid = false;
	}elseif (($apptend - $apptstart) > 80000){
		$messages[] = "What kind of appointment takes that long, dude?";
                $valid = false;
	}
	

        if (!$valid) {
                $_SESSION['sentiment'] = "bad";
                $_SESSION['messages'] = $messages;
                header("Location: dashboard.php");
                exit;
        }else{
                $_SESSION['sentiment'] = "good";
                $_SESSION['messages'][0] = array("Appointment added.");
                try{
                        $dao->addAppointment($BXID, $EMPID, $CXID, apptstart, apptend);
                        $_SESSION['access_granted'] = true;
                        header("Location: dashboard.php");
                        exit;
                } catch (Exception $e) {
                        var_dump($e);
                        die;
                }
        }
?>
