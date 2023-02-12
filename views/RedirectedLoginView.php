<?php

class RedirectedLoginView {
  private $message;

  public function __construct($message) {
    $this->message = $message;
  }

  public function render() {
    include '../layouts/login.php';
    echo '<br>'.$this->message;
  }
}