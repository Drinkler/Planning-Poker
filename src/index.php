<?php
session_start();

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Planning-Poker</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/ionicons.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Features-Clean.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Footer-Clean.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Login-Form-Clean.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Navigation-with-Button.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Registration-Form-with-Photo.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Social-Icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/Testimonials.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css" />

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="script/script.js"></script>
</head>

<body>
    <?php
        include_once("templates/navbar.php");
    ?>

    <div class="features-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Planning Poker</h2>
                <p class="text-center">
                    Willkommen bei Planning Poker® Online. Diese Anwendung ist frei für jedermann. Als ein Scrum
                    Master können Sie hier eine Session erstellen und Ihr Team dazu einladen.&nbsp;
                </p>
            </div>
            <div class="col text-center" style="margin-bottom: 60px;">
                <a href="lobby.php">
                <button class="btn btn-primary" type="button">
                    Los geht's !
                </button>
                </a>
            </div>
            <div class="row features">
                <div class="col-sm-6 col-lg-4 item">
                    <i class="fa fa-clock-o icon"></i>
                    <h3 class="name">Hohe Verfügbarkeit</h3>
                    <p class="description">
                        Durch die Nutzung von AWS als Backend wird eine hohe Verfügbarkeit des Services
                        gewährleistet.
                    </p>
                </div>
                <div class="col-sm-6 col-lg-4 item">
                    <i class="fa fa-plane icon"></i>
                    <h3 class="name">Performant</h3>
                    <p class="description">
                        Als Datenbank wird eine&nbsp; AWS RDS verwendet. Höchste Performance und Sicherheit sind für
                        uns oberste Priorität.
                    </p>
                </div>
                <div class="col-sm-6 col-lg-4 item">
                    <i class="fa fa-phone icon"></i>
                    <h3 class="name">Mobile-first</h3>
                    <p class="description">
                        Während des Entwicklungsprozesses wurde stets das Mobile-first Prinzip verfolgt. Dadruch ist
                        eine Mobile Nutzung der Anwendung zu jeder Zeit möglich.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Nutzermeinungen</h2>
                <p class="text-center">Unsere Nutzer lieben uns! Lies was sie zu sagen haben.&nbsp;</p>
            </div>
            <div class="row people" id="reviewContainer">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box">
                        <p class="description">
                            Super Tool! Hilft uns beim Planen unserer User-Storys immer wieder aufs neue!
                        </p>
                    </div>
                    <div class="author">
                        <img class="rounded-circle" src="assets/img/1.jpg" />
                        <h5 class="name">Ben Johnson</h5>
                        <p class="title">CEO von camos Software &amp; Beratung GmbH.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box">
                        <p class="description">
                            Hat beim ersten mal überzeugt und wird es auch beim nächsten mal tun! Sehr innovativ
                            gestaltet.
                        </p>
                    </div>
                    <div class="author">
                        <img class="rounded-circle" src="assets/img/3.jpg" />
                        <h5 class="name">Carl Kent</h5>
                        <p class="title">CEO von Balluff GmbH.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once("templates/footer.php");
    ?>
</body>

</html>