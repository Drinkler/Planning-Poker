<?php

namespace PlanningPoker\Model;

use PlanningPoker\Library\Session;

/**
 * Class Lobby:
 *
 * @package PlanningPoker\Model
 * @author Florian Drinkler
 */
class Lobby extends ModelBase
{
    private $name;
    private $deck;
    private $created;

    private $creator_name;
    private $creator_surname;

    /**
     * Lobby constructor.
     * @param string $name
     * @param int $deck
     * @param string $created
     * @param string $creator_name
     * @param string $creator_surname
     * @author Florian Drinkler
     * @return void
     */
    public function __construct(string $name, int $deck, string $created, string $creator_name, string $creator_surname)
    {
        $this->setName($name);
        $this->setDeck($deck);
        $this->setCreated($created);
        $this->setCreator_name($creator_name);
        $this->setCreator_surname($creator_surname);
    }

    /**
     * Create: creates a lobby
     * @param $_name
     * @param $_cards
     * @param $_creator
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return bool
     */
    public static function create($_name, $_cards, $_creator)
    {
        $_name = htmlspecialchars($_name);
        $_cards = htmlspecialchars($_cards);

        if (!empty($_name) && !empty($_cards) && !empty($_creator)) {
            // Prepare params
            $params = array(
                ':name' => $_name,
                ':creator' => $_creator,
                ':deck' => $_cards
            );

            // Prepare query
            $query = /** @lang SQL */
                "INSERT INTO lobby (name, creator, deck) VALUES (:name, :creator, :deck)";

            try {
                // Execute query
                (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);

                return true;
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                return false;
            }
        } else {
            echo 'Wrong input is given.';
        }
    }

    /**
     * Join: joins a specific participant into a lobby
     * @access public
     * @param $_params
     * @param array $_returnArray
     * @return bool
     * @author Luca Stanger
     * @author Florian Drinkler
     */
    public static function join($_params, &$_returnArray = array()) {
        // Prepare query to check if user is already in this lobby
        $query =
            /** @lang SQL */
            "SELECT * FROM participants WHERE iduser = :iduser AND idlobby = :idlobby";
        try {
            $result = (new PDOBase)->getPdo()->query($query, $_params);
            if (!isset($result[0])) {
                $query =
                    /** @lang SQL */
                    "INSERT INTO participants (iduser, idlobby) VALUES (:iduser, :idlobby)";
                try {
                    (new PDOBase)->getPdo()->queryWithoutFetch($query, $_params);
                    return true;
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                    return false;
                }
            } else {
                $_returnArray = array(
                  "error" => "User is already a participant"
                );
                return false;
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            $_returnArray = array(
                "error" => $exception->getMessage()
            );
            return false;
        }
    }

    /**
     * FindAll: returns all lobbies
     * @param array $_returnArray
     * @return array|bool|string
     * @author Luca Stanger
     * @author Florian Drinkler
     */
    public static function findAll(&$_returnArray = array())
    {
        // Prepare empty params array for query function
        $params = array();
        // Prepare query
        $query =
            /** @lang SQL */
            "SELECT user.name as uname, user.surname as surname, lobby.created as created, lobby.name, lobby.creator as creator, lobby.idlobby as lobbyid FROM user, lobby WHERE user.iduser = lobby.creator";

        try {
            $_returnArray = (new PDOBase)->getPdo()->query($query, $params);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * GetCreatorByLobbyID
     * @param $_id
     * @param array $_returnArray
     * @author Luca Stanger
     * @return bool
     */
    public static function getCreatorByLobbyID($_id, &$_returnArray = array()) {
        $params = array(
          ":idlobby" => $_id
        );

        $query =
            /** @lang SQL */
            "SELECT creator FROM lobby WHERE idlobby = :idlobby";

        $_returnArray = (new PDOBase)->getPdo()->query($query, $params);

        return true;
    }


    /**
     * GetCardsByLobbyID
     * @param $_id
     * @param array $_returnArray
     * @author Luca Stanger
     * @return bool
     */
    public static function getCardsByLobbyID($_id, &$_returnArray = array()) {
        $params = array(
          ":idlobby" => $_id
        );

        $query =
            /** @lang SQL */
            "SELECT deck FROM lobby WHERE idlobby = :idlobby";

        $_returnArray = (new PDOBase)->getPdo()->query($query, $params);

        return true;
    }

    /**
     * @param $_id
     * @param array $_returnArray
     * @author Luca Stanger
     * @return bool
     */
    public static function getParticipants($_id, &$_returnArray = array()) {
        $params = array(
            ":idlobby" => $_id
        );

        $query =
            /** @lang SQL */
            "SELECT user.name, user.surname FROM participants, user WHERE idlobby = :idlobby AND participants.iduser = user.iduser";

        $_returnArray = (new PDOBase)->getPdo()->query($query, $params);

        return true;
    }

    /**
     * DeleteById: generic method for deleting a entry by its id
     * @param $_id
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return array|bool|string
     */
    public static function deleteById($_id)
    {
        $params = array(
            ":idlobby" => $_id
        );

        $query = /** @lang SQL */
            "DELETE FROM lobby WHERE idlobby = :idlobby LIMIT 1";


        (new PDOBase())->getPdo()->queryWithoutFetch($query, $params);

        return true;
    }

    /**
     * FindByCreator: return all lobbies from Creator
     * @author Florian Drinkler
     * @return bool
     */
    public static function findByCreator(&$_returnArray = array())
    {
        // Prepare empty params array for query function
        $params = array(
            ":creator" => Session::get("user")->getId()
        );
        // Prepare query
        $query =
            /** @lang SQL */
            "SELECT user.name as uname, user.surname as surname, lobby.created as created, lobby.name, lobby.creator as creator, lobby.idlobby as lobbyid FROM user, lobby WHERE user.iduser = lobby.creator AND creator = :creator;";

        try {
            $_returnArray = (new PDOBase)->getPdo()->query($query, $params);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    // Getter-Setter
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getDeck(): int
    {
        return $this->deck;
    }
    public function setDeck(string $deck)
    {
        $this->deck = $deck;
    }
    public function getCreated(): string
    {
        return $this->created;
    }
    public function setCreated(string $created)
    {
        $this->created = $created;
    }
    public function getCreator_name(): string
    {
        return $this->creator_name;
    }
    public function setCreator_name(string $creator_name)
    {
        $this->creator_name = $creator_name;
    }
    public function getCreator_surname(): string
    {
        return $this->creator_surname;
    }
    public function setCreator_surname(string $creator_surname)
    {
        $this->creator_surname = $creator_surname;
    }

    public function getSource()
    {
        return 'lobby';
    }
}
