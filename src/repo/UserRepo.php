<?php

namespace App\repo;

use PDO;

class UserRepo
{
    public function get_model()
    {
        return 'App\\models\\UserModel';
    }

    public function get_table()
    {
        return 'users';
    }

    public function get_user_by_email($db, $email)
    {
        $model = UserRepo::get_model();
        $table = UserRepo::get_table();
        
        $qry = $db->prepare("SELECT * FROM `$table` WHERE $table.u_mail= ?");
        $qry->execute([$email]);
        $qry->setFetchMode(PDO::FETCH_CLASS, $model);
        $data = $qry->fetch(PDO::FETCH_CLASS);

        return $data;

    }

    public function create_user($db, $mail, $pw, $name)
    {
        $model = UserRepo::get_model();
        $table = UserRepo::get_table();
        $time = date('Y-m-d H:i:s');

        $qry = $db->prepare("INSERT INTO `$table` (`u_mail`, `u_password`, `u_name`, `u_created`, `u_changed`) VALUES (:mail, :pw, :nm, :created, :changed)");
        $qry->execute(['mail' => $mail, 'pw' => $pw, 'nm' => $name, 'created' => $time, 'changed' => $time]);
    }
}