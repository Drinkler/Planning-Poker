<?php

class Issue
{
    var $title;
    var $description;

    function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    function setTitle(string $title)
    {
        $this->title = $title;
    }

    function setDescription(string $description)
    {
        $this->description = $description;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getDescription()
    {
        return $this->description;
    }
}
