<?php

spl_autoload_register(function ($class_name) {
    $db = include '../ModelBase/' . $class_name . '.php';
});

$db = new Database(
    $_SERVER['RDS_HOSTNAME'],
    $_SERVER['RDS_PORT'],
    $_SERVER['RDS_DB_NAME'],
    $_SERVER['RDS_USERNAME'],
    $_SERVER['RDS_PASSWORD'],
    'utf8'
);

User::setDb($db);
