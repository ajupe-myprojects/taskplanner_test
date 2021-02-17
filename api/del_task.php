<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\helpers\Validator;
use App\controllers\TaskController;
use App\core\Container;

$feedback = [];
$check = new Validator();
$tmp_container = new Container();

$tmp_db = $tmp_container->get_pdo();

$id = $check->validate('task_id', 'num');

if($id !== '!ERROR!')
{
    $back = TaskController::delete_task($id, $tmp_db);
    $feedback['log'] = $back;
    $data = TaskController::get_all($tmp_db);
    $feedback['data'] = $data;
}
else
{
    $feedback['log']['error'] = 'Missing or wrong inputs';
}

echo json_encode($feedback);

die;

