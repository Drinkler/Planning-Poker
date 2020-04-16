<?php
session_start();

require('session.php');
require('database.php');

// Check if user is already logged in
if (!isset($_SESSION['signed_in']) || $_SESSION['signed_in'] == false) {
    // TODO: Logik richtig machen
    header('Location: ../index.php');
    exit();
}

if (!empty($_POST["lobbyName"]) && !empty($_POST["cards"])) {
    $lobbyName = htmlspecialchars($_POST["lobbyName"]);
    $cards = htmlspecialchars($_POST["cards"]);
} else {
    echo "Wrong input is given.";
    exit();
}

$query = "INSERT INTO lobby (name, creator, deck) VALUES (:name, :creator, :deck)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':name', $lobbyName);
$stmt->bindParam(':creator', $_SESSION["iduser"], PDO::PARAM_INT);
$stmt->bindParam(':deck', $cards, PDO::PARAM_INT);
$stmt->execute();
