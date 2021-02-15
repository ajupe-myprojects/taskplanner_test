<?php
require_once __DIR__.'/constants.php';
require_once __DIR__.'/global_func.php';

//+++Session+++//
session_set_cookie_params(4000);
if(session_status() === PHP_SESSION_NONE) session_start();

gen_token();


require_once __DIR__.'/routes.php';

//+++ Header +++//
$primary_header = new App\helpers\HeaderBuilder();
$tmp_headers = $primary_header->get_headers();
$tmp_components = $primary_header->get_components();



