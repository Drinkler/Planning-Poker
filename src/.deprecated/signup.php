<?php
session_start();

require("database.php");

// Check if required data is given
if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $name = htmlspecialchars($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $email = htmlspecialchars($_POST["email"]);
    // hashing the password
    $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
} else {
    echo "Wrong input is given.";
    exit();
}

// Returns amount of how often the email is in the db.
// Should be either 1 or 0, because duplicates shouldn't be working.
$query = "SELECT COUNT(*) FROM user WHERE email=:email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":email", $email);
$stmt->execute();

// If the email is not yet in the db, user can sign up.
if (!$stmt->fetch()[0]) {

    // Create random value for confirmation.
    $challenge = md5(rand() . time());

    // Save new user in db.
    $query = "INSERT INTO user (name ,surname ,email ,password, challenge) VALUES (:name, :surname, :email, :password, :challenge)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':challenge', $challenge);
    $stmt->execute();

    // Link for email confirmation.
    // Should be send in an email, read documentation to see why in this project it was not done by email.
    echo "<a href='confirm.php?email=$email&challenge=$challenge'>Confirm Account</a>";
} else {
    echo "Email already exists.";
}
