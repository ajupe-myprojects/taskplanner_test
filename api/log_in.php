<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\controllers\UserController;
use App\core\Container;
use App\helpers\Validator;
use App\repo\UserRepo;

$feedback = [];
$check = new Validator();
$tmp_container = new Container();


$tmp_db = $tmp_container->get_pdo();

$email = $check->validate('usermail', 'mail');
$password = $check->validate('password', 'pw');
$token = $check->validate('crsf-token', 'tk');

if($email !== '!ERROR!' && $password !== '!ERROR!' && $token)
{
    $db_user = UserRepo::get_user_by_email($tmp_db, $email);
    $result = UserController::login($email, $password, $db_user);
}
else
{
    $feedback['result']['feedback'] = 'Email or password are missing';
}

$feedback['result'] = [$email, $password, $token];

echo json_encode($feedback);

die;