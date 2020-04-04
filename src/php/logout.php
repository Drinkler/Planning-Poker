<?php
session_start();
session_regenerate_id(); // Against hijacking

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
$_SESSION = array();
session_destroy();

header('Location: ../../login.php');
