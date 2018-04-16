<?php 

session_start();
require_once("Dao.php");
$dao = new Dao();

if(isset($_POST['b_id'])) {
        $BXID = $_POST['b_id'];
	$employees = $dao->getEmployees($BXID);
        foreach($employees as $employee) {
         
     echo "<option value =". $employee['rcdID'] . ">" .$employee['firstname'] . " " . $employee['lastname'] . "</option>" ;
}

}


?>

