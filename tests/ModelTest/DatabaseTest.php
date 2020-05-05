<?php

namespace PlanningPoker\tests;

use PHPUnit\Framework\TestCase;
use PlanningPoker\Model\Database;
use PlanningPoker\Model\PDOBase;

final class DatabaseTest extends TestCase
{
    /**
     * testCanBeConstructed: tests if an instance of PDO can be constructed
     * @return void
     * @author Luca Stanger
     */
    public function testCanBeConstructed()
    {

        // Required env for database creation
        $_SERVER['RDS_HOSTNAME'] = "test";
        $_SERVER['RDS_PORT'] = 3306;
        $_SERVER['RDS_DB_NAME'] = "testdb";
        $_SERVER['RDS_USERNAME'] = "testuser";
        $_SERVER['RDS_PASSWORD'] = "testpwd";

        // Assertion
        $this->assertInstanceOf(
            Database::class,
            (new PDOBase)->getPdo(),
            "Couldn't establish a PDO Connection"
        );
    }

    /**
     * testCanBeConstructedThroughConstructor: tests if an instance of PDO can be constructed
     * @return void
     * @author Luca Stanger
     */
    public function testCanBeConstructedThroughConstructor() {

    }
}