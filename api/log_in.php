<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\controllers\UserController;
use App\core\Container;
use App\helpers\Validator;
use App\repo\UserRepo;

$feedback = [];
$check = new Validator();
$tmp_container = new Container;

$tmp_db = $tmp_container->get_pdo();
$post_data = $data->get_all_inputs();


$email = $check->validate('usermail', 'mail');
$password = $check->validate('password', 'pw');

if($email !== '!ERROR!' && $password !== '!ERROR!')
{
    $db_user = UserRepo::get_user_by_email($tmp_db, $email);
    $result = UserController::login($email, $password, $db_user);
}
else
{
    $feedback['result']['feedback'] = 'Email or password are missing';
}

$feedback['result'] = $result;

echo json_encode($feedback);

die;