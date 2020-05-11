<?php

namespace PlanningPoker\Model;

/**
 * Class Issue:
 *
 * @package PlanningPoker\Model
 * @author Florian Drinkler
 */
class Issue
{
    private $id;
    private $title;
    private $description;

    /**
     * Issue constructor.
     * @param int $id
     * @param string $title
     * @param string $description
     * @author Florian Drinkler
     * @author Luca Stanger
     */
    public function __construct(int $id, string $title, string $description)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
    }

    /**
     * @param int $lobbyId
     * //TODO
     * @return bool
     */
    public function saveToLobbyId(int $lobbyId) {
        // Prepare params
        $params = array(
            ':idissue' => (int)htmlspecialchars($this->getId()),
            ':idlobby' => (int)htmlspecialchars($lobbyId),
            ':title' => htmlspecialchars($this->getTitle()),
            ':description' => htmlspecialchars($this->getDescription())
        );

        // Prepare query
        $query = /** @lang SQL */
            "INSERT INTO issue (idissue, idlobby, title, body) VALUES (:idissue, :idlobby, :title, :description)";

        try {
            // Execute query
            (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);

            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * getActiveIssueByLobbyId: Returns the currently selected active issue
     * @param $lobbyid
     * @param array $_returnArray
     * @return bool
     * @author Luca Stanger
     */
    public static function getActiveIssueByLobbyId($lobbyid, &$_returnArray = array()) {
        // Prepare params
        $params = array(
            ':idlobby' => $lobbyid
        );

        $query = /** @lang SQL */
            "SELECT * FROM issue WHERE issue.idlobby = :idlobby AND active = 1";

        $result = (new PDOBase)->getPdo()->query($query, $params);

        foreach ($result as $item) {
            array_push($_returnArray, new Issue($item["idlobby"], $item["title"], $item["body"]));
        }

        return true;

    }

    private function setTitle(string $title)
    {
        $this->title = $title;
    }

    private function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
