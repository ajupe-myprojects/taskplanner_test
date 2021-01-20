<?php
//session_start();
require_once '../autoload.php';
require_once '../config/init.php';

use App\controllers\UserController;

$test = UserController::check_login();
if(isset($_SESSION['login']))
{
    $feedback = [
        'error' => false,
        'mail' => $test['u_mail'],

    ];
    echo json_encode($feedback);
}
else
{
    echo json_encode(['error' => true]);
}


die;