<?php


class User
{
    private static $_db;

    public static function create($_name, $_surname, $_email, $_password, $_hashType = PASSWORD_DEFAULT) {

        if (!empty($_name) && !empty($_surname && !empty($_email) && !empty($_password))) {
            // Escape parameters
            $_name = htmlspecialchars($_name);
            $_surname = htmlspecialchars($_surname);
            $_email = htmlspecialchars($_email);
            $_password = password_hash(htmlspecialchars($_password), $_hashType);
        } else {
            return false;
        }

        // Prepare params
        $params = array(
            ':email' => $_email
        );

        // Prepare query
        $query = "SELECT COUNT(*) FROM user WHERE email=:email";

        $result = self::$_db->query($query, $params);

        if (!$result[0][0]) {

            // Create random value for confirmation.
            $challenge = md5(rand() . time());

            // Prepare params
            $params = array(
              ':name' => $_name,
              ':surname' => $_surname,
              ':email' => $_email,
              ':password' => $_password,
              ':challenge' => $challenge
            );

            // Prepare query
            $query = "INSERT INTO user (name ,surname ,email ,password, challenge) VALUES (:name, :surname, :email, :password, :challenge)";

            $result = self::$_db->query($query, $params);

            return "<a href='" . self::confirm($_email, $challenge)  . "'>Confirm Account</a>";

        }
    }

    public static function confirm($_email, $_challenge) {
        // Escape parameters
        $_email = htmlspecialchars($_email);
        $_challenge = htmlspecialchars($_challenge);

        if (!empty($_email) && !empty($_challenge)) {

            // Prepare params
            $params = array(
              ':email' => $_email
            );

            // Prepare query
            $query = "SELECT challenge FROM user WHERE email=:email";

            // Execute query
            $result = self::$_db->query($query, $params);

            // If the returned challenge is equal, confirm user
            if ($result[0]['challenge'] == $_challenge) {
                // Prepare query
                $query = "UPDATE user SET confirmed = 1 WHERE email=:email";

                // Execute query
                self::$_db->query($query, $params);

                // TODO: Check if proper using of header here?
                header("Location: ../index.php");
            } else {
                return 'User not authorized.';
            }
        } else {
            return 'Wrong input is given';
        }

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

    public static function get_gravatar( $email, $s = 80, $d = 'retro', $r = 'g', $img = false, $atts = array() ) {
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