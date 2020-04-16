<?php

require("database.php");
require("classes/Review.php");

function getReviews()
{
    global $pdo;
    $reviews = array();

    // Get reviews from database
    $query = "SELECT r.title, r.description, r.rating, r.created, u.name, u.surname FROM user u, review r WHERE r.iduser = u.iduser";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Save reviews as Review object in array
    foreach ($result as $review) {
        array_push($reviews, new Review($review["title"], $review["description"], $review["created"], $review["rating"], $review["name"], $review["surname"]));
    }

    return $reviews;
}
