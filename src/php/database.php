<?php

// Server variables are defined as Environment variables
$dbhost = $_SERVER['RDS_HOSTNAME'];
$dbport = $_SERVER['RDS_PORT'];
$dbname = $_SERVER['RDS_DB_NAME'];
$charset = 'utf8';

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];

try {
    $pdo = new PDO($dsn, $username, $password);

    /**
     * https://www.php.net/manual/en/pdo.error-handling.php
     * 
     * Set Error Mode. At the moment it's in debug mode.
     */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

/**
 * Calling PDO::prepare() and PDOStatement::execute() for statements that will be issued multiple times with
 * different parameter values optimizes the performance of your application by allowing the driver to negotiate
 * client and/or server side caching of the query plan and meta information, and helps to prevent SQL injection
 * attacks by eliminating the need to manually quote the parameters.
 */
