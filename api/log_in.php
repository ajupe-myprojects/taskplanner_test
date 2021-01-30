<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\controllers\UserController;
use App\core\Container;
use App\helpers\InputHelper;
use App\repo\UserRepo;

$feedback = [];
$data = new InputHelper();
$tmp_container = new Container;

$tmp_db = $tmp_container->get_pdo();
$post_data = $data->get_all_inputs();

$email = isset($post_data['usermail']) && $post_data['usermail'] !== '' ? $post_data['usermail'] : '';
$password = isset($post_data['password']) && $post_data['password'] !== '' ? $post_data['password'] : '';

$db_user = UserRepo::get_user_by_email($tmp_db, $email);
$result = UserController::login($email, $password, $db_user);

$feedback['result'] = $result;

echo json_encode($feedback);

die;