<?php

class Lobby
{
    private $name;
    private $deck;
    private $created;

    private $creator_name;
    private $creator_surname;

    public function __construct(string $name, int $deck, string $created, string $creator_name, string $creator_surname)
    {
        $this->setName($name);
        $this->setDeck($deck);
        $this->setCreated($created);
        $this->setCreator_name($creator_name);
        $this->setCreator_surname($creator_surname);
    }

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
}

