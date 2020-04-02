<?php

require('database.php');

// $email = htmlspecialchars($_POST["login"]);
// $password = htmlspecialchars($_POST["password"]);

$result = $link->query("SELECT * FROM user");

while ($row = $result->fetch_assoc()) {
    echo $row['nickname'] . "<br>";
}
