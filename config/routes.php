<?php

use App\controllers\UserController;
use App\core\Container;
use App\core\Router;

$container = new Container;
$routes = [
    '/home' => ['Home', 'home', array()],
    '/home_user' => ['Task', 'home_week', array()],
    '/login_start' => ['User', 'show_login', array()],
    '/login' => ['User', 'login', array()],
    '/signup' => ['User', 'signup', array()],
    '/logout' => ['User', 'logout', array()],
];


function getRoute($routes, $container)
{
    $path_info = $_SERVER['REQUEST_URI'] ?? '';

    $rt = new Router($routes, $container);

    
    if(isset($routes[$path_info]))
    {
        $rt->use_route($path_info);

    }
    else
    {
        $rt->use_route('/home');

    }
}
