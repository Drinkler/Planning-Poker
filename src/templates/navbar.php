<?php
    echo "<!-- Modal LogIn -->
    <div class=\"modal fade\" id=\"loginModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"loginModalLabel\" aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"loginModalLabel\">Login</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <form method=\"post\" action=\"php/login.php\">
                    <div class=\"modal-body\">
                        <h2 class=\"sr-only\">Login Form</h2>
                        <div class=\"form-group\">
                            <input class=\"form-control\" type=\"email\" name=\"email\" placeholder=\"Email\" />
                        </div>
                        <div class=\"form-group\">
                            <input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Password\" />
                        </div>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Schließen</button>
                        <button type=\"submit\" class=\"btn btn-primary\">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal LogIn -->
    <!-- Modal SignUp -->
    <div class=\"modal fade\" id=\"signupModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"signupModalLabel\" aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"signupModalLabel\">Konto erstellen</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <form method=\"post\" action=\"php/signup.php\">
                    <div class=\"modal-body\">
                        <h2 class=\"sr-only\">SignUp Form</h2>
                        <div class=\"form-group\">
                            <input class=\"form-control\" type=\"text\" name=\"name\" placeholder=\"Vorname\" />
                        </div>
                        <div class=\"form-group\">
                            <input class=\"form-control\" type=\"text\" name=\"surname\" placeholder=\"Nachname\" />
                        </div>
                        <div class=\"form-group\">
                            <input class=\"form-control\" type=\"email\" name=\"email\" placeholder=\"Email\" />
                        </div>
                        <div class=\"form-group\">
                            <input class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Password\" />
                        </div>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Schließen</button>
                        <button type=\"submit\" class=\"btn btn-primary\">Erstellen</button>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"g-recaptcha\" data-sitekey=\"6LcbPuYUAAAAABSvTUYDZHeistTNRv0omkLpnMYK\" data-callback=\"verifyRecaptchaCallback\" data-expired-callback=\"expiredRecaptchaCallback\"></div>
                        <input class=\"form-control d-none\" data-recaptcha=\"true\" data-error=\"Please complete the Captcha\" />
                        <div class=\"help-block with-errors\"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal SignUp -->
    <!-- Login Button -->
    <nav class=\"navbar navbar-light navbar-expand-md navigation-clean-button dropleft\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"index.php\">
            <img src='assets/img/planning_icon.png' width=\"30px\" height=\"30px\" class=\"d-inline-block align-top\" alt=\"\">
            Planning Poker
            </a>    
            <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
            <ul class=\"navbar-nav\">
              <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"sessions.php\">Sessions <span class=\"sr-only\">(current)</span></a>
              </li>
            </ul>
          </div>";
    include("php/checkLoginForNavBar.php");
    echo "</div></nav>";
