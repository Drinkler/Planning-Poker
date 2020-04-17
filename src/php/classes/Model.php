<?php


class Model
{
    protected $_db;

    public function __construct(Database $db)
    {
        $this->_db = $db;
    }
}