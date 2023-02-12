<?php
require '../vendor/autoload.php';
require '../Router.php';

session_start();

$router = new Router();
$router->get('/post/new', 'PostController::new');
$router->get('/posts', 'PostController::index');
$router->post('/post', 'PostController::add');
$router->get('/postsPage', 'PostController::indexPage');
$router->get('/login/new', 'LoginController::new');
$router->post('/login', 'LoginController::add');
$router->post('/logout', 'LoginController::out');
$router->get('/registration/new', 'RegistrationController::new');
$router->post('/registration', 'RegistrationController::add');
$router->_404('ErrorController::_404');

$view = $router->dispatch();
$view->render();
