<?php
session_start();

require('session.php');
require('database.php');

$result = User::create($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]);
echo $result;