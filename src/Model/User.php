<?php

namespace PlanningPoker\Model;

use PlanningPoker\Library\Session;
use PlanningPoker\Library\Text;

/**
 * Class User:
 *
 * @package PlanningPoker\Model
 * @author Luca Stanger
 */
class User extends ModelBase
{
    private $_id, $_name, $_surname, $_email, $_created, $_username, $_vote;

    /**
     * User constructor.
     * @param int $_id
     * @param string $_name
     * @param string $_surname
     * @param string $_email
     * @param int $_vote
     * @author Luca Stanger
     */
    public function __construct($_id, $_name, $_surname, $_email, $_vote = 0)
    {
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_surname = $_surname;
        $this->_email = $_email;
        $this->_vote = $_vote;
        $this->_username = $this->_name . " " . $this->_surname;
    }


    /**
     * Creates a new user
     * @param $_name
     * @param $_surname
     * @param $_email
     * @param $_password
     * @param string $_hashType
     * @param array() $returnArray
     * @return boolean
     * @author Luca Stanger
     * @author Florian Drinkler
     */
    public static function create($_name, $_surname, $_email, $_password, $_hashType = PASSWORD_DEFAULT, array &$returnArray = array())
    {

        if (!empty($_name) && !empty($_surname && !empty($_email) && !empty($_password))) {
            // Escape parameters
            $_name = htmlspecialchars($_name);
            $_surname = htmlspecialchars($_surname);
            $_email = htmlspecialchars($_email);
            $_password = password_hash(htmlspecialchars($_password), $_hashType);
        } else {
            // Return false if one of the inputs is missing
            $returnArray = array(
                'error' => Text::get("USER_CREATE_MISSING_INPUT")
            );
            return false;
        }

        // Prepare params
        $params = array(
            ':email' => $_email
        );

        // Prepare query
        $query =
            /** @lang SQL*/
            "SELECT COUNT(*) FROM user WHERE email=:email";

        $result = (new PDOBase)->getPdo()->query($query, $params);

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
            $query =
                /** @lang SQL */
                "INSERT INTO user (name ,surname ,email ,password, challenge) VALUES (:name, :surname, :email, :password, :challenge)";

            // Execute query
            (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);

            $returnArray = array(
                'email' => $_email,
                'challenge' => $challenge
            );
            return true;
        }
        $returnArray = array(
            'error' => Text::get("USER_CREATE_EXCEPTION")
        );
        return false;
    }

    /**
     * Confirms the submitted useraccount if the challenge is correct
     * @param $_email
     * @param $_challenge
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return string
     */
    public static function confirm($_email, $_challenge)
    {
        // Escape parameters
        $_email = htmlspecialchars($_email);
        $_challenge = htmlspecialchars($_challenge);

        if (!empty($_email) && !empty($_challenge)) {

            // Prepare params
            $params = array(
                ':email' => $_email
            );

            // Prepare query
            $query =
                /** @lang SQL */
                "SELECT challenge FROM user WHERE email=:email";

            // Execute query
            $result = (new PDOBase)->getPdo()->query($query, $params);

            // If the returned challenge is equal, confirm user
            if ($result[0]['challenge'] == $_challenge) {
                // Prepare query
                $query =
                    /** @lang SQL */
                    "UPDATE user SET confirmed = 1 WHERE email=:email";

                // Execute query
                (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Logs in the submitted user
     * @param $_email string doesn't need to be htmlspecialchars
     * @param $_password string doesn't need to be htmlspecialchars
     * @param array() $_returnArray
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return bool returns true if user got logged in successfully
     */
    public static function login($_email, $_password, &$_returnArray = array())
    {
        // Check if user is already logged in
        if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
            $_returnArray = array(
                'error' => Text::get("USER_ALREADY_SINGED_IN")
            );
            return false;
        }

        // Escape input
        if (!empty($_email) && !empty($_password)) {
            $_email = htmlspecialchars($_email);
            $_password = htmlspecialchars($_password);
        } else {
            $_returnArray = array(
                'error' => Text::get("USER_CREATE_MISSING_INPUT")
            );
            return false;
        }

        // Prepare params
        $params = array(
            ':email' => $_email
        );

        // Prepare query
        $query =
            /** @lang SQL */
            'SELECT * FROM user WHERE email=:email';

        // Execute query on database
        $result = (new PDOBase)->getPdo()->query($query, $params);

        // Verify return
        if (password_verify($_password, $result[0]['password'])) {

            // Email needs to be confirmed
            if ($result[0]['confirmed'] == 1) {
                // User can Login
                // Save user data in session
                $user = new User($result[0]["iduser"], $result[0]["name"], $result[0]["surname"], $result[0]["email"]);

                // Put user object into session
                Session::put("user", $user);

                // Change user to signed in
                Session::put("signed_in", true);

                return true;
            } else {
                $_returnArray = array(
                    'error' => Text::get("USER_NOT_CONFIRMED")
                );
                return false;
            }
        } else {
            $_returnArray = array(
                'error' => Text::get("USER_PASSWORD_INCORRECT")
            );
            return false;
        }
    }

    /**
     * Logs out the current user
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return bool
     */
    public static function logout()
    {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        } else {
            return false;
        }

        Session::delete("signed_in");

        return true;
    }

    /**
     * Deletes the current user account
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return void
     */
    public static function delete()
    {
        // Prepare params
        $params = array(
            ':iduser' => Session::get("user")->getId()
        );

        //Prepare query
        $query =
            /** @lang SQL */
            'DELETE FROM user WHERE iduser = :iduser';

        (new PDOBase)->getPdo()->query($query, $params);

        return true;
    }

    /**
     * Returns a gravtar for the submitted email
     * @param $email
     * @param int $s
     * @param string $d
     * @param string $r
     * @param bool $img
     * @param array $atts
     * @author Luca Stanger
     * @return string
     */
    public static function get_gravatar($email, $s = 80, $d = 'retro', $r = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return 'user';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->_surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->_surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->_created = $created;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->_username = $username;
    }
}
