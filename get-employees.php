<?php 

session_start();
require_once("Dao.php");
$dao = new Dao();

if(isset($_POST['b_id'])) {
        $BXID = $_POST['b_id'];
	$employees = $dao->getEmployees($BXID);
        echo "<option value =0>No preference</option>" ;
        foreach($employees as $employee) {
         
     		echo "<option value =". $employee['employee_id'] . ">" .$employee['firstname'] . " " . $employee['lastname'] . "</option>" ;
	}

}

?>

