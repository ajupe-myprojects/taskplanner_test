<?php

define('FLROOT', $_SERVER['SCRIPT_NAME']);
define('ROOTDIR', $_SERVER['DOCUMENT_ROOT']);

require_once 'db.php';

define('DB_DATA', [
    'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',
    DB_USER,
    DB_PASSWORD
]);