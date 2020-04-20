<?php

require('database.php');

// Get data from url.
if (!empty($_GET['email']) && !empty($_GET['challenge'])) {
    $email = htmlspecialchars($_GET['email']);
    $challenge = htmlspecialchars($_GET['challenge']);
} else {
    echo "Wrong input is given.";
    exit();
}

// If email or challenge is not null or empty, proceed.
if (isset($email) && isset($challenge)) {

    // Get challenge from user in db for comparison.
    $query = "SELECT challenge FROM user WHERE email=:email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Compare challenge from the get request and db.
    if ($stmt->fetch()["challenge"] == $challenge) {

        // Update the user to confirmed.
        $query = "UPDATE user SET confirmed = 1 WHERE email=:email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        header("Location: ../index.php");
    } else {
        echo "User not authorized.";
    }
} else {
    echo "Wrong input is given.";
}
