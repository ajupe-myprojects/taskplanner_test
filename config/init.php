<?php
require_once __DIR__.'/constants.php';

//+++Session+++//
session_set_cookie_params(4000);
if(session_status() === PHP_SESSION_NONE) session_start();


require_once __DIR__.'/routes.php';

//+++ Header +++//
$primary_header = new App\helpers\HeaderBuilder();
$tmp_headers = $primary_header->get_headers();

//+++ Global Functions +++//

function e( string $str) : string
{
    $fstrg = htmlentities($str, ENT_QUOTES, 'UTF-8');
    return nl2br($fstrg);
}

function date_from_db($string)
{
    $timestamp = strtotime($string);
    return date('d.m.Y', $timestamp);
}
