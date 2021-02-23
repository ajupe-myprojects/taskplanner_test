<?php



use App\core\Router;



$routes = [
    '/home' => ['Home', 'home', array()],
    '/home_user' => ['Task', 'home_week', array()],
    '/login_start' => ['User', 'show_login', array()],
    '/login' => ['User', 'login', array()],
    '/signup' => ['User', 'signup', array()],
    '/logout' => ['User', 'logout', array()],

];
$routes_api = [
    '/del_task' => ['task', 'delete_task', array()]
];


function getRoute($routes, $routes_api, $container)
{
    $path_info = $_SERVER['REQUEST_URI'] ?? '';

    $rt = new Router($routes, $container);

    
    if(isset($routes[$path_info]))
    {
        $rt->use_route($path_info);

    }
    else if(isset($routes_api[$path_info]))
    {
        $rt->use_api_route($path_info);
    }

}
