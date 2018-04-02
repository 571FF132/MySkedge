<?php

require_once('Dao.php');
$dao = new Dao();
$rid = $_SESSION['RID'];
$appointments = $dao->getCXAppointments($rid);
$businesses = $dao->getBusinesses();
?>

<div><h1>MY SKEDGE</h1></div>

<table>
  <tr><th>Appointment Start</th><th>Appointment End</th><th>Business</th><th>Business Email</th><th>Employee</th><th>Employee Email</th><th>Delete</th></tr>
  <?php foreach ($appointments as $appointment) {
    echo "<tr><td>" . $appointment['timestamp_start'] ."</td>" .
         "<td>" . $appointment['timestamp_end'] . "</td>" .
         "<td>" . $appointment['name'] ."</td>" .
	 "<td>" . $appointment['owner_email'] ."</td>" .
	 "<td>" . $appointment['firstname'] . " " .$appointment['lastname'] . "</td>" .
	 "<td>" . $appointment['email'] ."</td>" .
	 "<td><a href='deleteappointment.php?bid=" .$appointment['business_id'] . "&eid=" .$appointment['employee_id'] . "&cid=" . $rid .
		 "&ts=" .$appointment['timestamp_start'] . "&te=" .$appointment['timestamp_end'] . "'>X</a></td>" .
         "</tr>";
  }
  ?>
</table>

<?php
     if (isset($_SESSION['messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['messages'] as $message) {
         echo "<div class='message $sentiment'>$message</div>";
         unset($message);
       }
     }
?>

<?php
     if (isset($_SESSION['error-messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['error-messages'] as $errormessage) {
         echo "<div class='errormessage $sentiment'>$errormessage</div>";
         unset($errormessage);
       }
     }
?>

<div class="appointment-form-wrapper">
        <form action="appointment-handler2.php" class="appointment-form" method="POST">
                <div class="form-area">
                        Business:
                        <select name="business-select">
                                <option value="0">Select a business</option>
                                <option value="business2">barber2</option>
                                <option value="business3">nailsalon3</option>
                                <option value="business4">mechanic4</option>
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
  				<option value="1">jdog test</option>
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
