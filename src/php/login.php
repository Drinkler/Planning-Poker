<?php
session_start();

require('session.php');
require('database.php');

// Check if user is already logged in
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    header('Location: ../index.php');
    exit();
}

// Check if input is given
if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
} else {
    echo "Wrong input is given.";
    exit();
}

// Query to get user with the input email
$query = "SELECT * FROM user WHERE email=:email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

// Check if a result comes back from the db. Only the first result gets checked.
if ($result = $stmt->fetch()) {
    // Verify hashed password from db with the input password
    if (password_verify($password, $result["password"])) {
        // Email needs to be confirmed
        if ($result["confirmed"] == 1) {
            // User can login
            // Save user data in session
            $_SESSION["signed_in"] = true;
            $_SESSION["iduser"] = $result["iduser"];
            $_SESSION["name"] = $result["name"];
            $_SESSION["surname"] = $result["surname"];
            $_SESSION["email"] = $result["email"];

            header("Location: ../index.php");
            exit();
        } else {
            echo "Email isn't confirmed.";
        }
    } else {
        echo "Wrong password.";
    }
} else {
    echo "Email doesn't exists.";
}
