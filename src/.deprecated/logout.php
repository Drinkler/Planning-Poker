<?php
session_start();
session_regenerate_id(); // Against hijacking

spl_autoload_register(function ($class_name) {
    include '../ModelBase/' . $class_name . '.php';
});

User::logout();
