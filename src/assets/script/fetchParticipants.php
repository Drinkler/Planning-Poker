<?php

session_start();

$id = $_SESSION["lobby"];


$result = array();

Lobby::getParticipants($id, $result);

echo $result;
