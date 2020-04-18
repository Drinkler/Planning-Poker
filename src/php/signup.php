<?php
session_start();

require('session.php');
require('database.php');

User::create($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]);
