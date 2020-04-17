<?php


class User
{
    private static $_db;



    public static function newUser() {

    }

    /**
     * @param $_email string doesn't need to be htmlspecialchars
     * @param $_password string doesn't need to be htmlspecialchars
     * @return bool returns true if user got logged in successfully
     */
    public static function login($_email, $_password) {
        $_email = htmlspecialchars($_email);
        $_password = htmlspecialchars($_password);
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

    public static function logout() {

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