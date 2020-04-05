<?php

if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo '<span class="actions">
                <a class="btn btn-light action-button" role="button" href="php/logout.php">Abmelden</a>
            </span>';
} else {
    echo '<span class="actions">
                <a class="login" data-toggle="modal" href="#loginModal">Log In</a>
                <a class="btn btn-light action-button" data-toggle="modal" data-target="#signupModal" role="button" href="#">Sign Up</a>
            </span>';
}
