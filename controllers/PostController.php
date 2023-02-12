<?php
require_once '../models/Post.php';
require_once '../views/PostAddView.php';
require_once '../views/PostListView.php';
require_once '../views/RedirectView.php';
require_once '../views/Error404View.php';

class PostController {
  public function new() {
    return new PostAddView();
  }

  public function add() {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $mark = $_POST['watermark'];
    $image_dir = "../web/images/";
    $image_file = $image_dir.basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));
    $uploadOk = 1;
    $image_name = basename($_FILES["image"]["name"]);

    if($mark === ''){
      return new Error404View("Sorry, watermark is obligatory.");
    }

    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        $uploadOk = 0;
      }
    }

    if (($_FILES["image"]["size"] > 1048576) && ($imageFileType != "jpg" && $imageFileType != "png")) {
      return new Error404View("Sorry, your file is too large and only JPG or PNG files are allowed");
      $uploadOk = 0;
    }
    
    if ($_FILES["image"]["size"] > 1048576) {
      return new Error404View("Sorry, your file is too large.");
      $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png") {
      return new Error404View("Sorry, only JPG anb PNG files are allowed.");
      $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
      return new Error404View("Sorry, your file was not uploaded.");
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_file)) {
        $uploadOk = 1;
      } else {
        return new Error404View("Sorry, there was an error uploading your file.");
      }
    }

    if($uploadOk == 1){
      if ($imageFileType == "jpg") {
        $img = imagecreatefromjpeg($image_file);
      }
      else $img = imagecreatefrompng($image_file);
      $width  = imagesx($img);
      $height = imagesy($img);

      $width_mini = 200;
      $height_mini = 125;
      $img_mini = imagecreatetruecolor($width_mini, $height_mini);

      imagecopyresampled($img_mini, $img, 0, 0, 0, 0, $width_mini, $height_mini, $width, $height);
      if ($imageFileType == "jpg") {
        imagejpeg($img_mini, $image_dir.'min_'.$image_name, 80);
      }
      else imagepng($img_mini, $image_dir.'min_'.$image_name, 5);

      $img_water = imagecreatetruecolor($width, $height);
      imagecopyresampled($img_water, $img, 0, 0, 0, 0, $width , $height, $width, $height);
      $mark_color = imagecolorallocate($img_water, 0, 191, 0);

      imagestring($img_water, 5, $width/2, $height/2, $mark, $mark_color);
      if ($imageFileType == "jpg") {
        imagejpeg($img_water, $image_dir.'water_'.$image_name, 80);
      }
      else imagepng($img_water, $image_dir.'water_'.$image_name, 5);

      imagedestroy($img);
      imagedestroy($img_mini);
      imagedestroy($img_water);
    }

    $post = new Post($title, $author, $image_name);
    $post->save();

    return new RedirectView('/post/new', 303);
  }

  public function index() {
    $posts = Post::getAll(1);
    $nr = Post::getCount();

    return new PostListView($posts, $nr);
  }

  public function indexPage() {
    $nr = $_GET['id'];
    $page = 1;
    for ($i = 1; $i <= $nr; $i++){
      if(isset($_GET['submit'.$i])){
        $page = $i;
      }
    }

    $posts = Post::getAll($page);
    $nr = Post::getCount();

    return new PostListView($posts, $nr);
  }
}
