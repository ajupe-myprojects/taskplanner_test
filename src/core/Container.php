<?php

namespace App\core;


use PDO;

class Container
{
    private $instance = [];

    public function __construct()
    {
        $pdo = new PDO(DB_DATA[0], DB_DATA[1] ?? NULL, DB_DATA[2] ?? NULL);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->instance = $pdo;
    }


    /**
     * Get a repository from the database
     * 
     * @return  sql_object
     */
    public function get_pdo()
    {
        return $this->instance;
    }
}