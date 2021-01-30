<?php

namespace App\controllers;

use App\core\AbstractController;
use App\repo\TaskRepo;
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

    public function get_home_tasks($db, $user_id)
    {
        $tmp_tasks = [];

        if(intval($user_id) > 0)
        {
            $all = TaskRepo::get_week_tasks($db);
            $tmp_tasks['data'] = $all;
            $tmp_tasks['error'] = 'none';
        }
        else
        {
            $tmp_tasks['error'] = 'no data';
        }

        return $tmp_tasks;
    }
}