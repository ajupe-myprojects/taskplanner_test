<?php

namespace App\models;


use App\core\AbstractModel;

class RepTaskModel extends AbstractModel
{
    public $rt_id;
    public $rt_user_id;
    public $rt_name;
    public $rt_description;
    public $rt_from;
    public $rt_to;
    public $rt_repeat_cycle;
    public $rt_created;
    public $rt_changed;

}