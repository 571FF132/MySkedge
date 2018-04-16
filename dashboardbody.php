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
    echo "<tr><td>" . htmlspecialchars($appointment['timestamp_start']) ."</td>" .
         "<td>" . htmlspecialchars($appointment['timestamp_end']) . "</td>" .
         "<td>" . htmlspecialchars($appointment['name']) ."</td>" .
	 "<td>" . htmlspecialchars($appointment['owner_email']) ."</td>" .
	 "<td>" . htmlspecialchars($appointment['firstname']) . " " . htmlspecialchars($appointment['lastname']) . "</td>" .
	 "<td>" . htmlspecialchars($appointment['email']) ."</td>" .
	 "<td><a href='deleteappointment.php?bid=" .$appointment['apptID'] . "'>DELETE</a></td>" .
         "</tr>";
  }
  ?>
</table>

<div class="appointment-form-wrapper">
        <form action="appointment-handler2.php" class="appointment-form" method="POST">
                <div class="form-area">
                        <label for="business-select">Business:</label>
                        <select name="business-select" id="business-select">
                                <option value="0">Select a business</option>
				<?php 
				foreach ($businesses as $business) {
					echo "<option value =". $business['rcdID'] . ">" .$business['name'] . "</option>" ;
  				}
  				?>
                        </select>
                </div>
                <div class="form-area">
                        <label for="employee-select">Employee:</label>
                        <select name="employee-select" id="employee-select">
                               <!-- <option value="0">No preference</option> -->
                               <option value="0">Select a business first</option>
                        </select>
                </div>
                <div class="form-area">
                        <label for="appointment-start-date">Appointment Start:</label>
                        <input name="appointment-start-date" type="date">
                        <input name="appointment-start-time" type="time">
                </div>
                <div class="form-area">
                        <label for="appointment-end-date">Appointment End:</label>
                        <input name="appointment-end-date" type="date">
                        <input name="appointment-end-time" type="time">
                </div>
                <div class="form-area">
                        <input name="appointment-submit-button" type="submit" value="Add Appointment">
                </div>

        </form>
</div>
