<?php

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

function gen_token()
{
    if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(8));
    }

    return $_SESSION['token'];
}