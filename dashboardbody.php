<?php

require_once('Dao.php');
$dao = new Dao();
$rid = $_SESSION['RID'];
$appointments = $dao->getCXAppointments($rid);

?>

<div><h1>MY SKEDGE</h1></div>

<ul>
  <?php foreach ($appointments as $appointment) {
    echo "<li><a href='appointment/details.php?id=" . $appointment["id"] . "'>" .$appointment["name"] . "</a></li>";
  }
  echo "<li>" . $rid . "</li>";
  ?>
</ul>

<div class="appointment-form-wrapper">
        <form action="appointment-handler.php" class="login-form" method="POST">
                <div class="form-area">
                        Business:
                        <select id="business-select">
                                <option value="business1">business1</option>
                                <option value="business2">barber2</option>
                                <option value="business3">nailsalon3</option>
                                <option value="business4">mechanic4</option>
                        </select>
                </div>
                <div class="form-area">
                        Employee:
                        <select>
                                <option value="any">No preference</option>
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
