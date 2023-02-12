<?php

class DB {
  private static $db = null;

  public static function get() {
    if (!isset(static::$db)) {
      static::$db = new MongoDB\Client(
        "mongodb://127.0.0.1:27017/wai",
        [
          'username' => 'wai_web',
          'password' => 'w@i_w3b'
        ]
      );
    }

    return static::$db->wai;
  }

  public static function savePost($title, $author, $image_name, $_id) {
    $response = DB::get()->posts->insertOne([
      'title' => $title,
      'author' => $author,
      'image_name' => $image_name
    ]);
    $_id = $response->getInsertedId();
  }

  public static function getPosts($selectedPage) {
  $page = $selectedPage;
    $pageSize = 5;
    $opts = [
      'skip' => ($page - 1) * $pageSize,
      'limit' => $pageSize
    ];
  $response = DB::get()->posts->find([], $opts);
    $posts = [];
    foreach ($response as $post) {
    $posts[] = new Post($post['title'], $post['author'], $post['image_name']);
    }
    return $posts;
  }

  public static function getNumber() {
    $response = DB::get()->posts->find([]);
    $counting = 0;
    foreach ($response as $post) {
      $counting++;
    }
    if(($counting % 5) == 0) {
      $numberOfPages = (int)(($counting / 5)-1);
    }
    else $numberOfPages = (int)($counting / 5);
    return $numberOfPages;
  }

  public static function saveUser($login, $pass, $email, $_id) {
    $response = DB::get()->users->insertOne([
      'login' => $login,
      'pass' => $pass,
      'email' => $email
    ]);
    $_id = $response->getInsertedId();
  }

  public static function checkNewUser($login) {
    $response = DB::get()->users->find([]);
    foreach($response as $loginCheck) {
        if($login == $loginCheck['login']){
            return false;
        }
    }
  }

  public static function checkLogin($login) {
      $logOK[] = 0;
      $response = DB::get()->users->find([]);
        foreach($response as $loginCheck) {
            if($login == $loginCheck['login']){
                $logOK[0] = 1;
                $logOK[1] = $loginCheck['pass'];
                return $logOK;
            }
        }
  }
}