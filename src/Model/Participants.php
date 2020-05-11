<?php


namespace PlanningPoker\Model;

use function Composer\Autoload\includeFile;

/**
 * Class Participants:
 *
 * @package PlanningPoker\Model
 * @author Luca Stanger
 */
class Participants extends ModelBase
{

    private $idparticipants, $iduser, $idlobby, $joined;

    /**
     * Participants constructor.
     * @param $idparticipants
     * @param $iduser
     * @param $idlobby
     * @param $joined
     * @author Luca Stanger
     */
    public function __construct($idparticipants, $iduser, $idlobby, $joined)
    {
        $this->idparticipants = $idparticipants;
        $this->iduser = $iduser;
        $this->idlobby = $idlobby;
        $this->joined = $joined;
    }

    /**
     * getParticipantsByLobby
     * @param $_idlobby
     * @param array $_returnArray inout parameter
     * @return bool returns true if the function was successful
     */
    public static function getParticipantsByLobby($_idlobby, &$_returnArray = array()) {

        // Check if id is set
        $_idlobby = ((isset($_idlobby)) ? $_idlobby : 0);

        // Prepare params
        $params = array(
            ':idlobby' => $_idlobby
        );

        // Prepare query
        $query = /** @lang SQL */
            "SELECT participants.*, user.* FROM participants, user WHERE participants.iduser = user.iduser AND participants.idlobby = :idlobby";

        // Execute query
        $result = (new PDOBase)->getPdo()->query($query, $params);

        foreach ($result as $value) {
            array_push($_returnArray, new User($value["iduser"], $value["name"], $value["surname"], $value["email"]));
        }

        return true;
    }


    public function getSource()
    {
        return 'participants';
    }


}