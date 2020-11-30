<?php

namespace App\repo;

use PDO;

class TaskRepo
{
    public function get_model()
    {
        return 'App\\models\\TaskModel';
    }

    public function get_table()
    {
        return 'tasks';
    }

    public function get_week_tasks($db, $date = '0000-00-00')
    {
        $model = TaskRepo::get_model();
        $table = TaskRepo::get_table();
        $rep_model = 'App\\models\\RepTaskModel';
        $date = date('Y-m-d H:i:s');

        // unique one term tasks
        $qry = $db->prepare("SELECT * FROM `$table` WHERE t_status != 'done'");
        $qry->execute();
        $qry->setFetchMode(PDO::FETCH_CLASS, $model);
        $data['unique'] = $qry->fetch(PDO::FETCH_CLASS);

        // repeatable tasks
        $qry = $db->prepare("SELECT * FROM `rep_tasks` WHERE DATE(':date') between rt_from and rt_to");
        $qry->execute(['date' => $date]);
        $qry->setFetchMode(PDO::FETCH_CLASS, $rep_model);
        $data['rep'] = $qry->fetch(PDO::FETCH_CLASS);


        return $data;
    }
}