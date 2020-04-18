<?php


class Model
{
    protected static $_db;

    /**
     * @return mixed
     */
    public static function getDb()
    {
        return self::$_db;
    }

    /**
     * @param mixed $db
     */
    public static function setDb($db)
    {
        self::$_db = $db;
    }

}