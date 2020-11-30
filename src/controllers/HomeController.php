<?php

namespace App\controllers;

use App\core\AbstractController;

use App\helpers\Auth;

class HomeController extends AbstractController
{

    public function home()
    {
        $user = Auth::is_user();
        $tmp_tasks = [];
        if(!$user)
        {
            $tmp_tasks['no_user'] = 'nope';
        }
        

        $this->view('view_home', $tmp_tasks);
    }
}