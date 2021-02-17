<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\helpers\Validator;
use App\controllers\TaskController;
use App\core\Container;

$feedback = [];
$task_new = [];
$check = new Validator();
$tmp_container = new Container();

$tmp_db = $tmp_container->get_pdo();

$task_new['t_name'] = $check->validate('t_name', 'text');
$task_new['t_description'] = $check->validate('t_description', 'text');
$task_new['t_done_by'] = $check->validate('t_done_by', 'date');
$task_new['t_user_id'] = $_SESSION['login']['u_id'];

if(!in_array('!ERROR!', $task_new))
{
    $fb = TaskController::add_task($task_new, $tmp_db);
    $feedback['log'] = $fb;
    $data = TaskController::get_all($tmp_db);
    $feedback['data'] = $data;
}
else
{
    $feedback['log']['error'] = 'Missing or wrong inputs';
}

echo json_encode($feedback);

die;