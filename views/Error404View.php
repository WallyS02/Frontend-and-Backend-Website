<?php

class Error404View {
  private $fail;

  public function __construct($fail) {
    $this->fail = $fail;
  }

  public function render() {
    http_response_code(404);
    include '../layouts/404.php';
    echo "Error occured: "."<br>".$this->fail;
  }
}
