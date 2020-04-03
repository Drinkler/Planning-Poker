<?php

require("database.php");

// Get required data
if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $name = $mysqli->real_escape_string(htmlspecialchars($_POST["name"]));
    $surname = $mysqli->real_escape_string(htmlspecialchars($_POST["surname"]));
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST["email"]));
    $password = password_hash($mysqli->real_escape_string(htmlspecialchars($_POST["password"])), PASSWORD_DEFAULT);
}

// TODO: Check if email already exists
$query = "SELECT COUNT(*) FROM user WHERE email=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if (!$result->fetch_array()[0]) {
    $query = "INSERT INTO user (name ,surname ,email ,password) VALUES (?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssss", $name, $surname, $email, $password);
    $stmt->execute();
    $stmt->close();

    header('Location: ../index.html');
} else {
    echo "Email existiert bereits.";
}
