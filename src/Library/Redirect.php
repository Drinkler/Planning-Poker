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
     * Logs the posted user in
     * @access public
     * @param string $location Contains the location, Default = ""
     * @return void
     * @author Luca Stanger
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