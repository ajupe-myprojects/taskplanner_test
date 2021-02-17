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

    public function get_week_tasks($db)
    {
        $model = 'App\\models\\TaskModel';
        $table = 'tasks';
        $rep_model = 'App\\models\\RepTaskModel';
        $date = date('Y-m-d H:i:s');

        // unique one term tasks
        $qry = $db->prepare("SELECT * FROM `$table` WHERE t_status != 'done'");
        $qry->execute();
        $qry->setFetchMode(PDO::FETCH_CLASS, $model);
        $data['unique'] = $qry->fetchAll(PDO::FETCH_CLASS);

        // repeatable tasks
        $qry = $db->prepare("SELECT * FROM `rep_tasks` WHERE DATE(':date') between rt_from and rt_to");
        $qry->execute(['date' => $date]);
        $qry->setFetchMode(PDO::FETCH_CLASS, $rep_model);
        $data['rep'] = $qry->fetchAll(PDO::FETCH_CLASS);


        return $data;
    }


    public function write_task_to_db($tasks, $db)
    {
        $model = 'App\\models\\TaskModel';
        $table = 'tasks';

        $query = $db->prepare("INSERT INTO `$table` (`t_name`, `t_description`, `t_done_by`, `t_user_id`) VALUES (:tname, :tdesc, :tdate, :tuser)");
        $err = $query->execute(['tname' => $tasks['t_name'], 'tdesc' => $tasks['t_description'], 'tdate' => $tasks['t_done_by'], 'tuser' => $tasks['t_user_id']]);

        return $err;
    }


    public function get_all_tasks($db)
    {
        $model = 'App\\models\\TaskModel';
        $table = 'tasks';
        $data = [];

        $qry = $db->prepare("SELECT * FROM `$table` WHERE t_status != 'done'");
        $qry->execute();
        $qry->setFetchMode(PDO::FETCH_CLASS, $model);
        $data['unique'] = $qry->fetchAll(PDO::FETCH_CLASS);

        return $data;
    }

    public function remove_tasks($id, $db)
    {
        $table = 'tasks';

        $err = $db->query("DELETE FROM `$table` WHERE t_id = '$id'");

        return $err;

    }


}