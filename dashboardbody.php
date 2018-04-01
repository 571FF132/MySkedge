<?php

require_once('Dao.php');
$dao = new Dao();
$rid = $_SESSION['RID'];
$appointments = $dao->getCXAppointments($rid);
$businesses = $dao->getBusinesses();
?>

<div><h1>MY SKEDGE</h1></div>

<ul>
  <?php foreach ($appointments as $appointment) {
    echo "<li>" . $appointment['business_id'] . $appointment['employee_id'] . "</li>";
  }
  ?>
</ul>

<?php
     if (isset($_SESSION['messages'])) {
       $sentiment = $_SESSION['sentiment'];
       foreach($_SESSION['messages'] as $message) {
         echo "<div class='message $sentiment'>$message</div>";
         unset($message);
       }
     }
?>

<div class="appointment-form-wrapper">
        <form action="appointment-handler2.php" class="login-form" method="POST">
                <div class="form-area">
                        Business:
                        <select id="business-select">
                                <option value="0">Select a business</option>
                                <option value="business2">barber2</option>
                                <option value="business3">nailsalon3</option>
                                <option value="business4">mechanic4</option>
				<?php foreach ($businesses as $business) {
    echo "<option value ='". $business['business_id'] . "'>" .$business['name'] . "</option>" ;
  }
  echo "<li>" . $rid . "</li>";
  ?>
                        </select>
                </div>
                <div class="form-area">
                        Employee:
                        <select>
                                <option value="0">No preference</option>
  				<option value="41">jdog test</option>
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
