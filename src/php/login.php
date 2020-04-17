<?php
session_start();

require('session.php');

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
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

//TODO: Check if input is given
User::login($_POST['email'], $_POST['password']);



