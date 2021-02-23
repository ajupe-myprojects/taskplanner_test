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

    public function get_all($db)
    {
        $stuff = TaskRepo::get_all_tasks($db);

        return $stuff;
    }

    public function add_task(array $data, $db)
    {
        $err = TaskRepo::write_task_to_db($data, $db);

        if($err)
        {
            return ['error'=> 'Task added'];
        }
        else
        {
            return ['error'=> 'Task not added / db error'];
        }
    }

    public function delete_task($id, $db)
    {
        TaskRepo::remove_tasks($id, $db);

        /* $stuff = TaskRepo::get_all_tasks($db);

        echo json_encode(['data' => $stuff]); */

        if(true)
        {
            return ['error'=> 'Task removed'];
        }
        else
        {
            return ['error'=> 'Task not removed / db error'];
        }
    }
}