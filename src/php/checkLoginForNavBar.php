<?php

if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo '<span class="actions">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/2020-04-03 14_06_50-Window.png" width="40" height="40" class="img-circle" alt="@username"><span class="caret"></span></a>
                    <div class="dropdown-menu">
                        <p class="dropdown-header">Angemeldet als: <br>' . $_SESSION['name'] . ' ' .$_SESSION['surname'] .'</p>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Dein Profil</a>
                        <a href="#" class="dropdown-item">Deine Lobbys</a>
                        <div class="dropdown-divider"></div>
                        <a href="php/logout.php" class="dropdown-item">Abmelden</a>
                    </div>
                </div>
            </span>';
} else {
    echo '<span class="actions">
                <a class="login" data-toggle="modal" href="#loginModal">Log In</a>
                <a class="btn btn-light action-button" data-toggle="modal" data-target="#signupModal" role="button" href="#">Sign Up</a>
            </span>';
}
