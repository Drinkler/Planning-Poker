<?php

require('database.php');

// $email = $mysqli->real_escape_string(htmlspecialchars($_POST["login"]));
// $password = htmlspecialchars($_POST["password"]);
$email = "flo.drinkler@gmail.com";
$password = "test";

if (isset($email) && isset($password)) {
    $query = "SELECT * FROM user WHERE email=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($data = $result->fetch_assoc()) {
        if (password_verify($password, $data["password"])) {
        }
    }
}

$mysqli->close();
