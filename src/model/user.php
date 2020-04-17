<?php


class User
{
    private static $_db;

    public static function create() {

    }


    /**
     * Logs in the submitted user
     * @param $_email string doesn't need to be htmlspecialchars
     * @param $_password string doesn't need to be htmlspecialchars
     * @return bool returns true if user got logged in successfully
     */
    public static function login($_email, $_password) {
        // Check if user is already logged in
        if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
            header('Location: ../index.php');
            return false;
        }
        // Escape input
        if (!empty($_email) && !empty($_password)) {
            $_email = htmlspecialchars($_email);
            $_password = htmlspecialchars($_password);
        } else {
            echo "Wrong input is given.";
            return false;
        }
        // Prepare params
        $params = array(
            ':email' => $_email
        );
        // Prepare query
        $query = 'SELECT * FROM user WHERE email=:email';
        // Execute query on database
        $result = self::$_db->query($query, $params);
        // Verify return
        if (password_verify($_password, $result[0]['password'])) {
            // Email needs to be confirmed
            if ($result[0]['confirmed'] == 1) {
                // User can Login
                // Save user data in session
                $_SESSION["signed_in"] = true;
                $_SESSION["iduser"] = $result[0]["iduser"];
                $_SESSION["name"] = $result[0]["name"];
                $_SESSION["surname"] = $result[0]["surname"];
                $_SESSION["email"] = $result[0]["email"];
                $_SESSION["username"] = $_SESSION["name"] . " " . $_SESSION["surname"];

                header("Location: ../index.php");
                return true;
            } else {
                print_r('E-Mail is not confirmed.');
                return false;
            }
        } else {
            print_r('Wrong password.');
            return false;
        }
    }

    /**
     * Logs out the current user
     */
    public static function logout() {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        } else {
            return false;
        }

        $_SESSION = array();
        session_destroy();

        header('Location: ../index.php');

        return true;
    }

    /**
     * Deletes the current user account
     */
    public static function delete() {
        // Prepare params
        $params = array(
            ':iduser' => $_SESSION['iduser']
        );

        //Prepare query
        $query = 'DELETE FROM user WHERE iduser = :iduser';

        $result = self::$_db->query($query, $params);
    }

    public static function changeUserPassword() {

    }

    public static function sendNewPassword() {
        
    }

    /**
     * @return mixed
     */
    public static function getDb()
    {
        return self::$_db;
    }

    /**
     * @param mixed $db
     */
    public static function setDb($db)
    {
        self::$_db = $db;
    }
}