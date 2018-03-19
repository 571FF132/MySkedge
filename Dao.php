<?php
class Dao {
  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_b9b1f4a7bec7469";
  private $user = "b187b7773eec73";
  private $pass = "dd41374f";

  private function getConnection () {
    try {
      return
        new PDO("mysql:dbname={$this->db};host={$this->host}", $this->user, $this->pass);
    } catch (Exception $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function login($username, $password){
    $conn = $this->getConnection();
    $saveQ = "select * from Users where username = :username and password = :password";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    return $query->fetchAll();
  }

  public function signup($username, $password);
    $conn = $this->getConnection();
    $saveQ = "INSERT INTO Users (username, password) VALUES (:username, :password)";
    $query = $conn->prepare($saveQ);
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();
  }
 
}

?>
