<?php

require('database.php');

$email = $mysqli->real_escape_string(htmlspecialchars($_GET['email']));
$challenge = htmlspecialchars($_GET['challenge']);

if (isset($email) && isset($challenge)) {
    $query = "SELECT challenge FROM user WHERE email=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->fetch_assoc()["challenge"] == $challenge) {
        echo "Benutzer wurde registriert.";

        $query = "UPDATE user SET confirmed = 1 WHERE email=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();

        header("Location: ../index.html");
    } else {
        echo "not authorized.";
    }
} else {
    echo "Wrong Parameters";
}
