<?php
session_start();

require('session.php');
require('database.php');

function __autoload($class_name) {
    $class = 'classes/' . $class_name . '.php';
    if (file_exists($class)) {
        include $class;
    }
};

User::login($_POST['email'], $_POST['password']);



