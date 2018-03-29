<?php
require_once("KLogger.php");

class Dao {
  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_b9b1f4a7bec7469";
  private $user = "b187b7773eec73";
  private $pass = "dd41374f";
  private $klog;

  public function __construct() {
    $this->klog = new Klogger("/klog/MySkedge.log", Klogger::DEBUG);
  }

  public function getConnection () {
    $this->klog->LogDebug("Attempt getConnection");
    try {
     return
        new PDO("mysql:dbname={$this->db};host={$this->host}", $this->user, $this->pass);
    } catch (Exception $e) {
      echo "Connection failed: " . $e->getMessage();
      $this->klog->LogFatal($e);
    }
    $this->klog->LogDebug("Got connection to MySQL");
  }

  public function login($username, $password){
    $this->klog->LogDebug("Attempt login");
    $conn = $this->getConnection();
    $saveQ = "select * from user where username = :username and password = :password";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    return $query->fetch();
  }

  public function signup($username, $password){
    $conn = $this->getConnection();
    $saveQ = "INSERT INTO user (email, password) VALUES (:username, :password)";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();
  }

  public function getUser($rcdID){
    $conn = $this->getConnection();
    $saveQ = "select * from user where username = :username and password = :password";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    return $query->fetchAll();
  }

  public function addAppointment($BXID, $EMPID, $CXID, $TSSTART, $TSEND){
    $conn = $this->getConnection();
    $saveQ = "INSERT INTO appointment (business_id, employee_id, customer_id, timestamp_start, timestamp_end, created)
                               VALUES (:BXID, :EMPID, CXID, TSSTART, TSEND, CURRENT_TIMESTAMP)";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':BXID', $BXID);
    $query->bindParam(':EMPID', $EMPID);
    $query->bindParam(':CXID', $CXID);
    $query->bindParam(':TSSTART', $TSSTART);
    $query->bindParam(':TSEND', $TSEND);
    $query->execute();

  }
  public function getCXAppointments($CXID){
    $conn = $this->getConnection();
    $saveQ = "select * from appointment where  customer_id = :customer_id";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':customer_id', $CXID);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    return $query->fetchAll();
  }
}

?>
