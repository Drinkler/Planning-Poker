<?php

// Save lobby in db
// name: varchar(50)
// creator: fk iduser (int)
// deck: int
$query = "INSERT INTO lobby (name, creator, deck) VALUES (:name, :creator, :deck)";

// Get all lobbys from a creator
$query = "SELECT * FROM lobby WHERE creator = :iduser";

// Delete a lobby
$query = "DELETE FROM lobby WHERE idlobby = :idlobby";
