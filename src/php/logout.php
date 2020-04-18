<?php
session_start();
session_regenerate_id(); // Against hijacking

spl_autoload_register(function ($class_name) {
    include '../model/' . $class_name . '.php';
});

User::logout();
