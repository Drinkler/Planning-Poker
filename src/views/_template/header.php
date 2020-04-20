<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <title>Planning-Poker</title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css" />
        <?= $this->getCSS(); ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <form method="post" action="<?= $this->makeURL("user/login")?>">
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
                    <form method="post" action="<?= $this->makeURL("user/create");?>">
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
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button dropleft">
            <div class="container">
                <a class="navbar-brand" href="<?= $this->makeURL("index")?>">
                    <img src='assets/img/planning_icon.png' width="30px" height="30px" class="d-inline-block align-top" alt="">
                    Planning Poker
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    <a class="nav-link" href="<?= $this->makeURL("sessions/index") ?>">Sessions</a>
                    </li>
                </ul>
            </div>
            <?= $this->getFile("_template/navigation") ?>
            </div>
        </nav>
