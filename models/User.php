<?php
require_once '../DB.php';

class User {
  public $login;
  public $pass;
  public $email;
  private $_id;

  public function __construct($login, $pass, $email) {
    $this->login = $login;
    $this->pass = $pass;
    $this->email = $email;
  }

  public function save() {
    DB::saveUser($this->login, $this->pass, $this->email, $this->_id);
  }
}