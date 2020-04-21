<?php

namespace PlanningPoker\Library;

/**
 * Class Redirect:
 *
 * @package PlanningPoker\Library
 * @author Luca Stanger
 */
class Redirect
{
    /**
     * To: Redirects to a specific path.
     * @access public
     * @param string $location [optional]
     * @return void
     */
    public static function to($location = "") {
        if ($location) {
            if ($location === 404) {
                header('HTTP/1.0 404 Not Found');
                include 'views/_template/404.phtml';
            } else {
                header("Location: " . $location);
            }
            exit();
        }
    }
}