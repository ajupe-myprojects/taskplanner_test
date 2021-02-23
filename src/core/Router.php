<?php

namespace App\core;

use App\core\Container;

use App\controllers\HomeController;

class Router
{
    private $routes;
    private $database;

    public function __construct(array $routes, $container)
    {
        $this->routes = $routes;
        $this->database = $container;
    }

    public function use_route($key)
    {
        if(array_key_exists($key, $this->routes))
        {
            $tmp_route = $this->routes[$key];
            $tmp_name = 'App\\controllers\\' . $tmp_route[0] . 'Controller';
            $tmp_method = $tmp_route[1];
            
            $tmp_con = new $tmp_name($this->database->get_pdo());
            
            $tmp_con->$tmp_method(!empty($tmp_route[2]) ? $tmp_route[2]: '');
        }

    }

    public function use_api_route($key)
    {
        if(array_key_exists($key, $this->routes))
        {
            $tmp_route = $this->routes[$key];
            $tmp_name = 'App\\controllers\\' . $tmp_route[0] . 'Controller';
            $tmp_method = $tmp_route[1];
            $tmp_con = new $tmp_name($this->database->get_pdo());

            $tmp_name::$tmp_method($tmp_con);

        }
    }

}