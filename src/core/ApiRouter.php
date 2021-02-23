<?php

namespace App\helpers;

class ApiRouter
{
    private $database;

    public function __construct($db)
    {
        $this->database = $db;
    }

    public function route($con, $method, $props)
    {
        $result = 'App\\controllers\\' .$con::$method($props, $this->database);

        return $result;
    }
}