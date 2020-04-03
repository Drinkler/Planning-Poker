<?php

require('../database.php');

$sql = "SELECT * FROM reviews";
$result = $link->query($sql);

try {
    if ($array = mysqli_fetch_assoc($result)) {
        echo $array["content"];
        exit();
    }
} catch (Exception $exception) {
    echo $exception;
    exit();
}