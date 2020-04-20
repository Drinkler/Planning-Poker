<?php


namespace PlanningPoker\Library;


class Redirect
{
    /**
     * To: Redirects to a specific path.
     * @access public
     * @param string $location [optional]
     * @return void
     * @since 1.0.1
     */
    public static function to($location = "") {
        if ($location) {
            if ($location === 404) {
                header('HTTP/1.0 404 Not Found');
                include 'views/_template/404.php';
            } else {
                header_remove();
                header("Location: " . $location);
            }
            exit();
        }
    }
}