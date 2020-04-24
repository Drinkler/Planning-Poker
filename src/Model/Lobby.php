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
            $query = "INSERT INTO lobby (name, creator, deck) VALUES (:name, :creator, :deck)";

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
     * FindAll: returns all lobbies
     * @author Luca Stanger
     * @author Florian Drinkler
     * @return array|bool|string
     */
    public static function findAll(&$_returnArray = array())
    {
        // Prepare empty params array for query function
        $params = array();
        // Prepare query
        $query =
            /** @lang SQL */
            "SELECT user.name as uname, user.surname as surname, lobby.created as created, lobby.name, lobby.creator as creator FROM user, lobby WHERE user.iduser = lobby.creator";

        try {
            $_returnArray = (new PDOBase)->getPdo()->query($query, $params);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
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
            "SELECT user.name as uname, user.surname as surname, lobby.created as created, lobby.name, lobby.creator as creator FROM user, lobby WHERE user.iduser = lobby.creator AND creator = :creator;";

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
