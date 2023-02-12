<?php

require_once '../views/LoginView.php';
require_once '../views/Error404View.php';
require_once '../views/RedirectedLoginView.php';
require_once '../views/LogedView.php';
require_once '../views/RedirectView.php';
require_once '../DB.php';

class LoginController {
    public function new() {
        if(isset($_SESSION['user'])) {
            return new LogedView();
        }
        return new LoginView();
    }

    public function add() {
        $login = $_POST['login'];
        $pass = $_POST['password'];

        $logOK = DB::checkLogin($login)[0];
        $lookedPass = DB::checkLogin($login)[1];
        
        if ($logOK == 0) {
            return new RedirectedLoginView('Wrong login');
        }
        if (!password_verify($pass, $lookedPass)) {
            return new RedirectedLoginView('Wrong password');
        }

        $_SESSION['user'] = $login;

        return new LogedView();
    }

    public function out() {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
        session_destroy();
        return new RedirectView('/login/new', 303);
    }
}