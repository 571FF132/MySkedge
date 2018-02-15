<?php
class Dao {
  private $host = "us-cdbr-iron-east-05.cleardb.net";
  private $db = "heroku_b9b1f4a7bec7469";
  private $user = "b187b7773eec73";
  private $pass = "dd41374f";

  private function getConnection () {
    try {
      return
        new PDO("mysql:dbname={$this->db};host={$this->host}", $this->user, $this->pass)
    } catch (Exception $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function connect(){
   $conn = $this->getConnection();
  }
 
}

?>
