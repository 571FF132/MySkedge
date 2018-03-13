<?php
session_start();

require_once("Dao.php");
$dao = new Dao();
$appointments = $dao->getAppointments();
require_once("header.php");
?>




<div><h1>MY SKEDGE PIRU LOVE</h1></div>

<ul>
  <?php foreach ($appointments as $appointment) {
    echo "<li><a href='appointment/details.php?id=" . $appointment["id"] . "'>" .$appointment["name"] . "</a></li>";
  } ?>
</ul>


<?php
require_once("footer.php");
?>

