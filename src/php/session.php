<?php

/*
    *   Could update "session.gc_maxlifetime" and "session.cookie_lifetime" in php.ini
    *   to the same time as "$_SESSION['LAST_ACTIVITY']" is set.
    */

// After 30 days, logout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30 * 24 * 60 * 60))) {
    require('logout.php');
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

// After 30 minutes, renew session id
// trying to prefent Session fixation
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > (30 * 60)) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}
