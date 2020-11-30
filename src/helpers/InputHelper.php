<?php

namespace App\helpers;

class InputHelper
{
    private $post_data;

    public function __construct()
    {
        $this->post_data = array_merge($_GET, $_POST);
    }

    public function get_all_inputs()
    {
        return $this->post_data;
    }

    public function get_one_input($key)
    {
        if(isset($this->post_data[$key]))
        {
            return $this->post_data[$key];
        }
        else
        {
            return false;
        }
    }
}