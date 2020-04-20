<?php

namespace PlanningPoker\Model;

class Issue
{
    private $title;
    private $description;

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
