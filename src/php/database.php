<?php
// $link = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

$link = new mysqli("planning-poker.cztpemauxamy.eu-central-1.rds.amazonaws.com", "admin", "LSuFDaaenPfdVWEi4S", "planning_poker", "3306");

if (!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
