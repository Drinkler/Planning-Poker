<?php
session_start();

require('session.php');
require('database.php');

// User already logged in
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    header('Location: ../index.php');
    exit();
}

if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);
}

$query = "SELECT * FROM user WHERE email=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$results = $stmt->get_result();
$stmt->close();

if ($data = $results->fetch_assoc()) {
    if (password_verify($password, $data["password"])) {
        if ($data["confirmed"] == 1) {
            // User can login
            echo "signed in";
            $_SESSION["signed_in"] = true;
            $_SESSION["iduser"] = $data["iduser"];

            header("Location: ../index.php");
        }
    } else {
        echo "Wrong password";
    }
}

$mysqli->close();
