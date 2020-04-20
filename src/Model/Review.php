<?php

namespace PlanningPoker\Model;

class Review extends ModelBase
{
    private $title;
    private $description;
    private $date;
    private $rating;

    private $name;
    private $surname;

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
