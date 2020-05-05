<?php


namespace ModelTest;


use PHPUnit\Framework\TestCase;
use PlanningPoker\Model\Lobby;

class LobbyTest extends TestCase
{

    public static $lobby;

    /**
     *
     */
    public static function setUpBeforeClass(): void
    {
        self::$lobby = new Lobby(
            "name",
            1,
            "05.05.2020",
            "creatorName",
            "creatorSurname");
    }

    /**
     * testCanBeConstructed: tests if an instance of Lobby can be constructed
     * @return void
     * @author Luca Stanger
     */
    public function testCanBeConstructed() {
        $this->assertInstanceOf(
            Lobby::class, self::$lobby, "Lobby could not be constructed properly"
        );
    }

    /**
     * testShouldReturnName: tests if getName returns String
     * @return void
     * @author Luca Stanger
     */
    public function testShouldReturnName() {
        $this->assertIsString(
            self::$lobby->getName(), "getName did not return a string"
        );
        $this->assertEquals(
            "name",
            self::$lobby->getName(),
            "getName returned the wrong name"
        );
    }

    /**
     * testShouldReturnDeck: tests if getDeck returns int
     * @return void
     * @author Luca Stanger
     */
    public function testShouldReturnDeck() {
        $this->assertIsInt(
            self::$lobby->getDeck(), "getDeck did not return a int"
        );
        $this->assertEquals(
            1,
            self::$lobby->getDeck(),
            "getDeck returned the wrong deck"
        );
    }

    /**
     * testShouldReturnCreated: tests if getCreated returns string
     * @return void
     * @author Luca Stanger
     */
    public function testShouldReturnCreated() {
        $this->assertIsString(
            self::$lobby->getCreated(), "getCreated did not return a date"
        );
        $this->assertEquals(
            "05.05.2020",
            self::$lobby->getCreated(),
            "getCreated returned the wrong deck"
        );
    }

    /**
     * testShouldReturnCreatorName: tests if getCreatorName returns a string
     * @return void
     * @author Luca Stanger
     */
    public function testShouldReturnCreatorName() {
        $this->assertIsString(
            self::$lobby->getCreator_name(), "getCreatorName did not return a string"
        );
        $this->assertEquals(
            "creatorName",
            self::$lobby->getCreator_name(),
            "getCreatorName returned the wrong name"
        );
    }

    /**
     * testShouldReturnCreatorSurname: tests if getCreatorSurname returns a string
     * @return void
     * @author Luca Stanger
     */
    public function testShouldReturnCreatorSurname() {
        $this->assertIsString(
            self::$lobby->getCreator_name(), "getCreatorSurname did not return a string"
        );
        $this->assertEquals(
            "creatorSurname",
            self::$lobby->getCreator_surname(),
            "getCreatorSurname returned the wrong name"
        );
    }

}