<?php
require_once("KLogger.php");

class Dao {
  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_b9b1f4a7bec7469";
  private $user = "b187b7773eec73";
  private $pass = "dd41374f";
  private $klog;

  public function __construct() {
    $this->klog = new Klogger('/klog/', Klogger::DEBUG);
  }

  public function getConnection () {
    $this->klog->LogDebug("Attempt getConnection");
    try {
     $connection = new PDO("mysql:dbname={$this->db};host={$this->host}", $this->user, $this->pass);
    } catch (Exception $e) {
      $this->klog->LogFatal($e);
      exit;
    }
    $this->klog->LogDebug("getConnection Success"); 
    return $connection;
  }

  public function login($email, $password){
    $conn = $this->getConnection();
    $this->klog->LogDebug("Attempt login");
    $saveQ = "select * from user where email = :email";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':email', $email);
    $query->execute();
    $data = $query->fetch();
    $hash = $data['password'];
    if (password_verify($password, $hash)) {
      $this->klog->LogDebug("Passwords match");
      $_SESSION['RID'] = $data['rcdID'];
      $_SESSION['sentiment'] = 'good';
      $_SESSION['messages'][0] = "Welcome " . trim($email)  . "!";
      $_SESSION['access_granted'] = true;
      header("Location:dashboard.php");
      exit();
    }
      $this->klog->LogDebug("Passwords do not match");
      $_SESSION['access_granted'] = false;
      $_SESSION['messages'][0] = "Email or Password not valid";
      $_SESSION['input']['email'] = $email;
       header("Location:login.php");
      exit();
  }

  public function verifySignup($email, $password, $firstname, $lastname){
    $conn = $this->getConnection();
    $saveQ = "select * from user where email = :email";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':email', $email);
    $query->execute();
    $returned = $query->fetch();
    unset($_SESSION['messages']);
    unset($_SESSION['verification_fail']);
    unset($_SESSION['sentiment']);	
    if($returned) {
      $_SESSION['messages'][0] = "An account already exists with that email.";
      $_SESSION['sentiment'] = "bad";
      $_SESSION['verification_fail'] = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['messages'][1] = "Invalid email.";
      $_SESSION['sentiment'] = "bad";
      $_SESSION['verification_fail'] = true;	
    }		
    if (!isset($email) || trim($email) == '') {
      $_SESSION['messages'][2] = "Email is required.";
      $_SESSION['sentiment'] = "bad";
      $_SESSION['verification_fail'] = true;
    }
    if (!isset($password) || trim($password) == '') {
      $_SESSION['messages'][3] = "Password is required.";
      $_SESSION['sentiment'] = "bad";
      $_SESSION['verification_fail'] = true;
    }
  }

  public function signup($email, $password, $firstname, $lastname){
    $conn = $this->getConnection();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $saveQ = "INSERT INTO user (email, password, firstname, lastname) VALUES (:email, :password, :firstname, :lastname)";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':firstname', $firstname);
    $query->bindParam(':lastname', $lastname);
    $query->execute();
    $this->klog->LogDebug("Insert new user into database");
    $_SESSION['access_granted'] = true;
    $_SESSION['messages'][0] = "Welcome " . trim($email)  . "!";
    $_SESSION['sentiment'] = "good";	
  }

  public function getUser($email){
    $conn = $this->getConnection();
    $saveQ = "select * from user where email = :email";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':email', $email);
    $query->execute();
    return $data = $query->fetch();
  }

  public function verifyAppointment($BXID, $EMPID, $CXID, $TSSTART, $TSEND){
    $this->klog->LogDebug("Attempt verify appt");
    unset($_SESSION['messages']);
    unset($_SESSION['verification_fail']);
    unset($_SESSION['sentiment']);
    if($BXID == "0"){
      $_SESSION['messages'][0] = "Please select a business.";
      $_SESSION['sentiment'] = "bad";
      $_SESSION['verification_fail'] = true;
    }

    if ($TSSTART > $TSEND) {
      $_SESSION['messages'][1] = "Appointment cannot end before it starts.";
      $_SESSION['sentiment'] = "bad";
      $_SESSION['verification_fail'] = true;
    }      
  }

  public function addAppointment($BXID, $EMPID, $CXID, $TSSTART, $TSEND){
    $this->klog->LogDebug("Attempt add apt`");
      if($EMPID == "0"){ /*No preference for employee*/
      $conn = $this->getConnection();
      $saveQ = "select * from employee where business_id = :BXID";
      $query = $conn->prepare($saveQ);
      $query->bindParam(':BXID', $BXID);
      $query->execute();
      $data = $query->fetch();
      $emp = $data['employee_id'];
    }else{
     $emp = $EMPID;
    }
    $conn = $this->getConnection();
    $saveQ = "INSERT INTO appointment (business_id, employee_id, customer_id, timestamp_start, timestamp_end, created)
                               VALUES (:BXID, :EMPID, :CXID, :TSSTART, :TSEND, CURRENT_TIMESTAMP)";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':BXID', $BXID);
    $query->bindParam(':EMPID', $emp);
    $query->bindParam(':CXID', $CXID);
    $query->bindParam(':TSSTART', $TSSTART);
    $query->bindParam(':TSEND', $TSEND);
    $query->execute();
    $_SESSION['error-messages'] = $query->errorInfo();
    if ($_SESSION['error-messages'][0] == "00000"){
    $_SESSION['messages'][0] = "Appointment added.";
    $_SESSION['sentiment'] = "good";
    } else {
    $_SESSION['messages'][0] = "Appointment not added. Something went wrong.";
    $_SESSION['sentiment'] = "bad";
    }
  }
  public function getCXAppointments($CXID){
    $conn = $this->getConnection();
    $saveQ = "select appointment.business_id, appointment.employee_id, timestamp_start, timestamp_end, name, owner_email, firstname, lastname, user.email, user.phone, user.address, user.zipcode
 from appointment
 join business on business_id = business.rcdID
 join user on appointment.employee_id = user.rcdID Where customer_id = :customer_id Order By timestamp_start";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':customer_id', $CXID);
    $query->execute();
    return $data = $query->fetchAll();
  }
 
  public function getBusinesses(){
    $conn = $this->getConnection();
    $saveQ = "select * from business";
    $query = $conn->prepare($saveQ);
    $query->execute();
    return $data = $query->fetchAll();
  }

  public function getEmployees($BXID){
    $conn = $this->getConnection();
    $saveQ = "select * from employee where business_id = :business_id";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':business_id', $BXID);
    $query->execute();
    return $data = $query->fetchAll();
  }

  public function deleteCXappointment($BXID, $EMPID, $CXID, $TSSTART, $TSEND){
    unset($_SESSION['messages']);
    unset($_SESSION['sentiment']);
    $conn = $this->getConnection();
    $saveQ = "DELETE FROM appointment 
	WHERE business_id = :BXID and employee_id = :EMPID and customer_id = :CXID
		and timestamp_start = :TSSTART and timestamp_end = :TSEND";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':BXID', $BXID);
    $query->bindParam(':EMPID', $emp);
    $query->bindParam(':CXID', $CXID);
    $query->bindParam(':TSSTART', $TSSTART);
    $query->bindParam(':TSEND', $TSEND);
    $query->execute();
    $_SESSION['error-messages'] = $query->errorInfo();
    if ($_SESSION['error-messages'][0] == "00000"){
    $_SESSION['messages'][0] = "Appointment Deleted.";
    $_SESSION['messages'][1] = "TSSTART " . $TSSTART . "Appointment Deleted.";
    $_SESSION['sentiment'] = "good";	
    } else {
    $_SESSION['messages'][0] = "Appointment not Deleted. Something went wrong.";
    $_SESSION['sentiment'] = "bad";
    } 	
  }

}

?>
