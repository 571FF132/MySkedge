<?php

class User {

  protected $username;
  protected $password;

  public function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  public function __toString() {
    return "username: " . $this->username. " ?password: " . $this->password;
  }

  public function getUser($username) {
    $data = file_get_contents("users.data");
    $users = explode("\n", trim($data));
    foreach($users as $user){
      $user = explode("|", trim($user))

    }
  }

}

$user = new User("jstiffler", "fuckyou");
print $user;

try {
  echo $user->getUser("ckennington"). "\n";
}catch  (Exception $e) {
  echo $e->getMessage() . "\n";   
}
