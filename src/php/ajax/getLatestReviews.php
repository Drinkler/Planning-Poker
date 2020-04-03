<?php

require('../database.php');

$sql = "SELECT * FROM review";
$result = $mysqli->query($sql);
$array = [];
try {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($array, $row);
    }
    echo json_encode($array);
} catch (Exception $exception) {
    echo $exception;
    exit();
}