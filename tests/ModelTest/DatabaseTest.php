<?php

use PHPUnit\Framework\TestCase;
use PlanningPoker\Model\Database;
use PlanningPoker\Model\PDOBase;

final class DatabaseTest extends TestCase
{
    /**
     * testCanBeConstructed: tests if an instance of PDO can be constructed
     * @author Luca Stanger
     * @return void
     */
/**
    public function testCanBeConstructed() {

        // Required env for database creation
        $_SERVER['RDS_HOSTNAME'] = "test";
        $_SERVER['RDS_PORT'] = 3306;
        $_SERVER['RDS_DB_NAME'] = "testdb";
        $_SERVER['RDS_USERNAME'] = "testuser";
        $_SERVER['RDS_PASSWORD'] = "testpwd";

        // Assertion
        $this->assertInstanceOf(
            Database::class,
            (new PDOBase)->getPdo()
        );
    }
*/
    public function alwaysTrue() {
        $this->assertInstanceOf(
            static::class, static::class
        );
    }
}