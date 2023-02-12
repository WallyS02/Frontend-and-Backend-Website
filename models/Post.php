<?php
require '../DB.php';

class Post {
  public $title;
  public $author;
  public $image_name;
  private $_id;

  public function __construct($title, $author, $image_name) {
    $this->title = $title;
    $this->author = $author;
    $this->image_name = $image_name;
  }

  public function save() {
    DB::savePost($this->title, $this->author, $this->image_name, $this->_id);
  }

  public static function getAll($selectedPage) {
    $posts = DB::getPosts($selectedPage);
    return $posts;
  }
  public static function getCount() {
    $numberOfPages = DB::getNumber();
    return $numberOfPages;
  }
}
