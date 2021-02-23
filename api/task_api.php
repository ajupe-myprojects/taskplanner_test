<?php

require_once '../autoload.php';
require_once '../config/init.php';

use App\helpers\Validator;
use App\helpers\ApiRouter;

$feedback = [];
$val = new Validator();
$db = $container->get_pdo();
$router = new ApiRouter($db);

$data = $val->get_api_data();

if(!in_array('!ERROR!', $data))
{
    $feedback = $router->route($data['con'], $data['method'], $data['data']);
}



echo json_encode($feedback);

die;
