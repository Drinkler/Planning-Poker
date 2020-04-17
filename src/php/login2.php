<?php
session_start();

require('session.php');

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

//TODO: Check if user is already signed in

//TODO: Check if input is given
$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
//TODO: Database Erzeugung muss man auslagern
$db = new Database(
    $_SERVER['RDS_HOSTNAME'],
    $_SERVER['RDS_PORT'],
    $_SERVER['RDS_DB_NAME'],
    $_SERVER['RDS_USERNAME'],
    $_SERVER['RDS_PASSWORD'],
    'utf8'
);

// Prepare params
$params = array(
    ':email' => $email
);

// Prepare query
$query = 'SELECT * FROM user WHERE email=:email';

$queryResult = $db->query($query, $params);

//TODO: Finish login properly
echo json_encode($queryResult);