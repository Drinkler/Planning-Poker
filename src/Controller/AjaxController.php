<?php


namespace PlanningPoker\Controller;

use PlanningPoker\Model\Issue;
use PlanningPoker\Model\Participants;

/**
 * Class AjaxController:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
class AjaxController extends ControllerBase implements Controller
{

    /**
     * Stores an Issue into the database
     * @access public
     * @example ajax/storeIssue
     * @return void
     * @author Luca Stanger
     */
    function storeIssueAction() {
        $issue = new Issue($_GET["id"], $_GET["title"], $_GET["body"], $_GET["number"]);
        $issue->saveToLobbyId($_SESSION["lobby"]);
    }

    function getParticipantsAction() {
        $lobbyid = $_GET["idlobby"];

        $returnArray = array();

        Participants::getParticipantsByLobby($lobbyid, $returnArray);

        foreach ($returnArray as $key=>$item) {
            $returnArray[$key] = (array) $item;
        }

        echo json_encode($returnArray);
    }

}