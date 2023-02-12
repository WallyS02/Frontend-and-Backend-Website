<?php

class PostListView {
  private $posts;
  private $nr;

  public function __construct($posts, $nr) {
    $this->posts = $posts;
    $this->nr = $nr;
  }

  public function render() {
    $posts = $this->posts;
    $nr = $this->nr;
    include '../layouts/postlist.php';
  }
}
