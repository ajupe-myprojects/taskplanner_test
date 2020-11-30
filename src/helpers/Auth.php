<?php

namespace App\helpers;


class Auth
{
    public function is_user()
    {
        if(isset($_SESSION['login']) && !empty($_SESSION['login']))
        {
            return $_SESSION['login'];
        }
        else
        {
            return false;
        }
    }
}