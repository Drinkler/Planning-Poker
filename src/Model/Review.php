<?php

namespace PlanningPoker\Model;

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
