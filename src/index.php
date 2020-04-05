<?php
session_start();

if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {

}
?>

<!DOCTYPE html>
<html>

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
    <!-- Modal LogIn -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="php/login.php">
                    <div class="modal-body">
                        <h2 class="sr-only">Login Form</h2>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal LogIn -->
    <!-- Modal SignUp -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Konto erstellen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="php/signup.php">
                    <div class="modal-body">
                        <h2 class="sr-only">SignUp Form</h2>
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Vorname" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="surname" placeholder="Nachname" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-primary">Erstellen</button>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcbPuYUAAAAABSvTUYDZHeistTNRv0omkLpnMYK" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                        <input class="form-control d-none" data-recaptcha="true" data-error="Please complete the Captcha" />
                        <div class="help-block with-errors"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal SignUp -->
    <!-- Login Button -->
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
            <a class="navbar-brand" href="#">Planning Poker</a>
            <?php
                include_once("php/checkLoginForNavBar.php");
            ?>

        </div>
    </nav>
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
                <button class="btn btn-primary" type="button">
                    Los geht's !
                </button>
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
    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="services/webdesign">Web design</a></li>
                            <li><a href="services/development">Entwicklung</a></li>
                            <li><a href="services/hosting">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Info</h3>
                        <ul>
                            <li><a href="about/project">Projekt</a></li>
                            <li><a href="about/team">Team</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social">
                        <a href="https://github.com/Drinkler/Planning-Poker" target="_blank">
                            <i class="icon ion-social-github"></i>
                        </a>
                        <a href="#">
                            <i class="icon ion-android-mail"></i>
                        </a>
                        <p class="copyright">Florian Drinkler, Luca Stanger © 2020</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- START Bootstrap-Cookie-Alert -->
    <div class="alert text-center cookiealert" role="alert">
        <b>Du magst Cookies?</b> &#x1F36A; Wir benutzen sie! Mit einem Klick auf Akzeptieren stimmst du der Nutzung
        dieser und unserer Website zu. <a href="https://cookiesandyou.com/" target="_blank">Learn more</a>

        <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
            Akzeptieren
        </button>
    </div>
    <!-- END Bootstrap-Cookie-Alert -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>
</body>

</html>