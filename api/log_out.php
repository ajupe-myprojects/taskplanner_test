<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\controllers\UserController;


$feedback = [];

$result = UserController::react_logout();

$feedback['result'] = $result;

echo json_encode($feedback);

die;