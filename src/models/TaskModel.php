<?php

namespace App\models;


use App\core\AbstractModel;

class TaskModel extends AbstractModel
{
    public $t_id;
    public $t_user_id;
    public $t_name;
    public $t_description;
    public $t_done_by;
    public $t_status;
    public $t_created;
    public $t_changed;

}