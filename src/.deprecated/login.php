<?php
session_start();

require('session.php');
require('database.php');

User::login($_POST['email'], $_POST['password']);
