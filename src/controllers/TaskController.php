<?php

namespace App\controllers;

use App\core\AbstractController;
use App\repo\TaskRepo;
use App\helpers\Auth;
use App\helpers\Calendar;


class TaskController extends AbstractController
{
    public function home_week()
    {
        $week = Calendar::get_seven_days();
        $data = [];
        foreach($week as $key => $day)
        {
            
        }
    }
}