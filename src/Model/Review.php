<?php

namespace PlanningPoker\Model;

use PlanningPoker\Library\Session;
use PlanningPoker\Library\Text;

/**
 * Class Review:
 *
 * @package PlanningPoker\Model
 * @author Florian Drinkler
 */
class Review extends ModelBase
{
    private $title, $description, $date, $rating, $name, $surname;

    /**
     * Review constructor.
     * @param string $title
     * @param string $description
     * @param string $date
     * @param int $rating
     * @param string $name
     * @param string $surname
     * @author Florian Drinkler
     * @return void
     */
    public function __construct(string $title, string $description, string $date, int $rating, string $name, string $surname)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setDate($date);
        $this->setRating($rating);
        $this->setName($name);
        $this->setSurname($surname);
    }

    public static function create($_title, $_description, $_rating, &$_returnArray = array())
    {
        // Get data from view
        if (!empty($_title) && !empty($_description) && !empty($_rating)) {
            $_title = htmlspecialchars($_title);
            $_description = htmlspecialchars($_description);
            $_rating = htmlspecialchars($_rating);
        } else {
            // TODO: Add REVIEW_CREATE_MISSING_INPUT to Text
            $_returnArray = array("error" => Text::get("REVIEW_CREATE_MISSING_INPUT"));
            return false;
        }

        // Prepare params
        $params = array(
            ":iduser" => Session::get("user")->getId(),
            ":title" => $_title,
            ":description" => $_description,
            ":rating" => $_rating
        );

        // Prepare query
        $query =
            /** @lang SQL */
            "INSERT INTO review (iduser, title, description, rating) VALUES (:iduser, :title, :description, :rating);";

        // Execute query
        try {
            (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);
        } catch (\Exception $exception) {
            $_returnArray = array("error" => $exception->getMessage());
            return false;
        }

        return true;
    }

    public static function delete($_idlobby, &$_returnArray = array())
    {
        // Prepare params
        $params = array(
            ":idreview" => $_idlobby
        );

        // Prepare query
        $query =
            /** @lang SQL */
            "DELETE FROM review WHERE idreview = :idreview;";

        // Execute query
        try {
            (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);
        } catch (\Exception $exception) {
            $_returnArray = array("error" => $exception->getMessage());
            return false;
        }

        return true;
    }

    public static function getAll(&$_returnArray = array())
    {
        // Prepare params
        $params = array();

        // Prepare query
        $query =
            /** @lang SQL */
            "SELECT r.title, r.description, r.rating, r.created, u.name, u.surname FROM user u, review r WHERE u.iduser = r.iduser;";

        // Execute query
        try {
            $_returnArray = (new PDOBase)->getPdo()->query($query, $params);
        } catch (\Exception $exception) {
            $_returnArray = array("error" => $exception->getMessage());
            return false;
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

    private function setDate(string $date)
    {
        $this->date = $date;
    }

    private function setRating(int $rating)
    {
        $this->rating = $rating;
    }

    private function setName(string $name)
    {
        $this->name = $name;
    }

    private function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getSource()
    {
        return 'review';
    }
}
