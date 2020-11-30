<?php

namespace App\core;

class AbstractController
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    protected function view($view, $params)
    {
        extract($params);
        include_once ROOTDIR."/views/content/{$view}.php";
    }
}