<?php

// Save lobby in db
// name: varchar(50)
// creator: fk iduser (int)
// deck: int
$query = "INSERT INTO lobby (name, creator, deck) VALUES (:name, :creator, :deck)";
