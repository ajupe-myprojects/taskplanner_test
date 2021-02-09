<?php

namespace App\helpers;


class Auth
{
    private $rights = [
        'Superadmin'    => 256,
        'Admin'         => 128,
        'Full'          => 64,
        'Normal'        => 32,
        'Limited'       => 16,
        'Guest'         => 8,
        'No Access'     => 0
    ];


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

    public function is_autorized(int $rflag)
    {
        foreach($this->rights as $key => $right)
        {
            if($rflag & $right)
            {
                return $key;
            }
        }
        return false;
    }
}