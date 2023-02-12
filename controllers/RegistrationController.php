<?php

require_once '../models/User.php';
require_once '../DB.php';
require_once '../views/RegistrationView.php';
require_once '../views/Error404View.php';
require_once '../views/RedirectedRegisterView.php';

class RegistrationController{
    public function new() {
        return new RegistrationView();
    }

    public function add() {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $pass = $_POST['password'];
    $rep_pass = $_POST['rep_password'];

    if($email === '' || $login === '' || $pass === '' || $rep_pass === '') {
        return new Error404View("Please complete all fields.");
    }

    if($pass != $rep_pass){
        return new Error404View("Sorry, you typed incorrect password and repeated password.");
    }

    $check = DB::checkNewUser($login);
    if($check == false) {
        return new Error404View("Sorry, this login is already taken.");
    }

    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

    $user = new User($login, $hashed_pass, $email);
    $user->save();

    return new RedirectedRegisterView('/registration/new', 303);
    }
}