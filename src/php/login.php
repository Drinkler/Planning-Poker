<?php
session_start();

require('session.php');

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

//TODO: Check if user is already signed in

$db = new Database(
    $_SERVER['RDS_HOSTNAME'],
    $_SERVER['RDS_PORT'],
    $_SERVER['RDS_DB_NAME'],
    $_SERVER['RDS_USERNAME'],
    $_SERVER['RDS_PASSWORD'],
    'utf8'
);

User::setDb($db);

//TODO: Check if input is given
User::login($_POST['email'], $_POST['password']);




$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);

//TODO: Database Erzeugung muss man auslagern
$db = new Database(
    $_SERVER['RDS_HOSTNAME'],
    $_SERVER['RDS_PORT'],
    $_SERVER['RDS_DB_NAME'],
    $_SERVER['RDS_USERNAME'],
    $_SERVER['RDS_PASSWORD'],
    'utf8'
);

// Prepare params
$params = array(
    ':email' => $email
);

// Prepare query
$query = 'SELECT * FROM user WHERE email=:email';

$queryResult = $db->query($query, $params);

// Verify hashed password from db with the input password
if (password_verify($password, $queryResult[0]["password"])) {
    // Email needs to be confirmed
    if ($queryResult[0]["confirmed"] == 1) {
        // User can login
        // Save user data in session
        $_SESSION["signed_in"] = true;
        $_SESSION["iduser"] = $queryResult[0]["iduser"];
        $_SESSION["name"] = $queryResult[0]["name"];
        $_SESSION["surname"] = $queryResult[0]["surname"];
        $_SESSION["email"] = $queryResult[0]["email"];
        $_SESSION["username"] = $_SESSION["name"] . " " . $_SESSION["surname"];

        header("Location: ../index.php");
        exit();
    } else {
        echo "Email isn't confirmed.";
    }
} else {
    echo "Wrong password.";
}

//TODO: Finish login properly
echo json_encode($queryResult);

