<?php

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'retro', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}


if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {

    echo '<span class="actions">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="'. get_gravatar($_SESSION['email']) .'" width="40" height="40" class="img-circle" alt="@username">
                    </a>
                    <div class="dropdown-menu">
                        <p class="dropdown-header">Angemeldet als: <br>' . $_SESSION['username'] .'</p>
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