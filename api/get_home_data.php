<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\controllers\UserController;
use App\controllers\HomeController;
use App\core\Container;
use App\helpers\InputHelper;


$feedback = [];
$data = new InputHelper();
$tmp_container = new Container;

$test = UserController::check_login();
$tmp_db = $tmp_container->get_pdo();
$post_data = $data->get_all_inputs();

if($test)
{
    $feedback['log'] = [
        'error' => false,
        'mail' => $test['u_mail'],
    ];
    $tasks = HomeController::get_home_tasks($tmp_db, $test['u_id'] );
    $feedback['data'] = $tasks;
}
else
{
    $feedback['log'] = [
        'error' => true,
        'mail' => 'none',
    ];
}





echo json_encode($feedback);

die;