<?php
session_start();

// TODO: Überprüfen ob User angemeldet ist, falls nicht -> Location index.php

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Planning-Poker</title>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic" />
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/fonts/ionicons.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Features-Clean.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Footer-Clean.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Login-Form-Clean.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Navigation-with-Button.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Registration-Form-with-Photo.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Social-Icons.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/Testimonials.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="../script/script.js"></script>
</head>

<body>
<?php
include_once("templates/navbar.php");
?>

<?php
include_once("templates/footer.php");
?>
</body>

</html>