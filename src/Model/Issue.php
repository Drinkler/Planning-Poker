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
    private $title;
    private $description;

    /**
     * Issue constructor.
     * @param string $title
     * @param string $description
     * @author Florian Drinkler
     * @return void
     */
    public function __construct(string $title, string $description)
    {
        $this->setTitle($title);
        $this->setDescription($description);
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
}
