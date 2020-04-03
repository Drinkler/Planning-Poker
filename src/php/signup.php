<?php

require("database.php");

// Get required data
if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $name = $mysqli->real_escape_string(htmlspecialchars($_POST["name"]));
    $surname = $mysqli->real_escape_string(htmlspecialchars($_POST["surname"]));
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST["email"]));
    $password = password_hash($mysqli->real_escape_string(htmlspecialchars($_POST["password"])), PASSWORD_DEFAULT);
}
// Check if email already exists
$query = "SELECT COUNT(*) FROM user WHERE email=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if (!$result->fetch_array()[0]) {

    $challenge = md5(rand() . time());

    $query = "INSERT INTO user (name ,surname ,email ,password, challenge) VALUES (?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssss", $name, $surname, $email, $password, $challenge);
    $stmt->execute();
    $stmt->close();

    echo "<a href='confirm.php?email=$email&challenge=$challenge'>Confirm Account</a>";
} else {
    echo "Email existiert bereits.";
}