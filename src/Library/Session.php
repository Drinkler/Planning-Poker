<?php

namespace PlanningPoker\Library;

/**
 * Class Session:
 *
 * @package PlanningPoker\Library
 * @author Luca Stanger
 */
class Session
{
    /**
     * Delete: Deletes the value of a specific key of the session.
     * @access public
     * @param string $key
     * @author Luca Stanger
     * @return boolean
     */
    public static function delete($key) {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    /**
     * Destroy: Deletes the session.
     * @access public
     * @author Luca Stanger
     * @return void
     */
    public static function destroy() {
        session_destroy();
    }

    /**
     * Exists: Checks if a specific key of a session exists.
     * @access public
     * @param string $key
     * @author Luca Stanger
     * @return boolean
     */
    public static function exists($key) {
        return(isset($_SESSION[$key]));
    }

    /**
     * Get: Returns the value of a specific key of the session if it exists.
     * @access public
     * @param string $key
     * @author Luca Stanger
     * @return string|nothing
     */
    public static function get($key) {
        if (self::exists($key)) {
            return($_SESSION[$key]);
        }
    }

    /**
     * Init: Starts the session.
     * @access public
     * @author Luca Stanger
     * @return void
     */
    public static function init() {
        // If no session exist, start the session.
        if (session_id() == "") {
            session_start();
        }
    }

    /**
     * Put: Sets a specific value to a specific key of the session.
     * @access public
     * @param string $key
     * @param string $value
     * @author Luca Stanger
     * @return string
     */
    public static function put($key, $value) {
        return($_SESSION[$key] = $value);
    }
}