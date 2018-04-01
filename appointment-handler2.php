<?php

session_start();
require_once("Dao.php");
$appointment = new Dao();

if (isset($_POST['appointment-submit-button'])) {
	$CXID = $_SESSION['RID'];
        $BXID = $_POST['business-select'];
        $EMPID = $_POST['employee-select'];
        $apptstartdate = $_POST['appointment-start-date'];
        $apptstarttime = $_POST['appointment-start-time'];
        $apptenddate = $_POST['appointment-end-date'];
        $apptendtime = $_POST['appointment-end-time'];
	/*$apptstart = DateTime::createFromFormat('Y-m-d H:i:s', $apptstartdate . $apptstarttime);
        $apptend = DateTime::createFromFormat('Y-m-d H:i:s', $apptenddate . $apptendtime);
	*/
	$apptstart = date('Y-m-d G:i:s', strtotime($_POST['appointment-start-date'].' '.$_POST['appointment-start-time']));
        $apptend = date('Y-m-d G:i:s', strtotime($_POST['appointment-end-date'].' '.$_POST['appointment-end-time']));

	$appointment->verifyAppointment($BXID, $EMPID, $CXID, $apptstart, $apptend);
	if (isset($_SESSION['verification_fail'])){
		header("Location:dashboard.php");
                exit;
        }else{
   		$appointment->addAppointment($BXID, $EMPID, $CXID, $apptstart, $apptend);
		header("Location:dashboard.php");
                exit;
        }
}
