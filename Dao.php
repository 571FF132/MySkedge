<?php
class Dao {
  private $host = "us-cdbr-east-04.cleardb.com";
  private $db = "heroku_f3d6b64b4b5dc57";
  private $user = "be7813156b6434";
  private $pass = "b7cb13a4";
  public function getConnection () {
    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", "{$this->user}", "{$this->pass}")
  }
 
}

?>
