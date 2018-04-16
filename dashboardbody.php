<?php

require_once('Dao.php');
$dao = new Dao();
$user = $dao->getUser($_SESSION['email']);
$rid = $_SESSION['RID'];
$appointments = $dao->getCXAppointments($rid);
$businesses = $dao->getBusinesses();
?>

<div><h1>MY SKEDGE</h1></div>

<?php
     if (isset($_SESSION['messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['messages'] as $message) {
         echo "<div class='message $sentiment'>$message</div>";
         unset($message);
       }
       unset($_SESSION['messages']);
     }
?>

<?php
     if (isset($_SESSION['error-messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['error-messages'] as $errormessage) {
       /*  echo "<div class='errormessage $sentiment'>$errormessage</div>"; */
         unset($errormessage);
       }
     }
?>


<table>
  <tr><th>Appointment Start</th><th>Appointment End</th><th>Business</th><th>Business Email</th><th>Employee</th><th>Employee Email</th><th>Delete</th></tr>
  <?php foreach ($appointments as $appointment) {
    echo "<tr><td>" . $appointment['timestamp_start'] ."</td>" .
         "<td>" . $appointment['timestamp_end'] . "</td>" .
         "<td>" . $appointment['name'] ."</td>" .
	 "<td>" . $appointment['owner_email'] ."</td>" .
	 "<td>" . $appointment['firstname'] . " " .$appointment['lastname'] . "</td>" .
	 "<td>" . $appointment['email'] ."</td>" .
	 "<td><a href='deleteappointment.php?bid=" .$appointment['apptID'] . "'>DELETE</a></td>" .
         "</tr>";
  }
  ?>
</table>

<div class="appointment-form-wrapper">
        <form action="appointment-handler2.php" class="appointment-form" method="POST">
                <div class="form-area">
                        Business:
                        <select name="business-select">
                                <option value="0">Select a business</option>
				<?php 
				foreach ($businesses as $business) {
					echo "<option value =". $business['rcdID'] . ">" .$business['name'] . "</option>" ;
  				}
  				?>
                        </select>
                </div>
                <div class="form-area">
                        Employee:
                        <select name="employee-select">
                                <option value="0">No preference</option>
                        </select>
                </div>
                <div class="form-area">
                        Appointment Start:
                        <input name="appointment-start-date" type="date">
                        <input name="appointment-start-time" type="time">
                </div>
                <div class="form-area">
                        Appointment End:
                        <input name="appointment-end-date" type="date">
                        <input name="appointment-end-time" type="time">
                </div>
                <div class="form-area">
                        <input name="appointment-submit-button" type="submit" value="Add Appointment">
                </div>

        </form>
</div>
