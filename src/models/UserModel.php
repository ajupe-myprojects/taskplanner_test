<?php

namespace App\models;

use App\core\AbstractModel;

class UserModel extends AbstractModel
{
    public $u_id;
    public $u_mail;
    public $u_name;
    public $u_password;
    public $u_created;
    public $u_changed;
    public $u_group;
    public $password_reset;
}