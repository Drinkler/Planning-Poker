<?php
session_start();

require('session.php');
require('database.php');

Lobby::create($_POST['lobbyName'], $_POST['cards'], $_SESSION['iduser']);