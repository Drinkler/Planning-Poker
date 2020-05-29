<?php


namespace PlanningPoker\Controller;

use PlanningPoker\Library\Session;
use PlanningPoker\Model\Issue;
use PlanningPoker\Model\Lobby;
use PlanningPoker\Model\Participants;
use PlanningPoker\Model\Vote;

/**
 * Class AjaxController:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
class AjaxController extends ControllerBase implements Controller
{
    /**
     * Activate a story for a specific lobby
     * @access public
     * @example ajax/storeIssue
     * @return void
     * @author Luca Stanger
     */
    function activateStoryAction() {
        $story = $_GET["story"];
        $lobby = Session::get("lobby");

        // Set all votes back to zero if switching an issue
        Issue::resetVotes($lobby);

        // Reset active status for all issues to ensure only 1 issue is active
        Issue::revokeActive($lobby);

        // Activate submitted issue for all users
        Issue::activate($lobby, $story);
    }

    /**
     * get average card score
     * @access public
     * @return void
     * @example ajax/avg
     * @author Luca Stanger
     */
    function avgAction() {
        $lobby = Session::get("lobby");

        $returnArray = array();

        if (Vote::getAvgScore($lobby, $returnArray)) {
            echo $returnArray[0]["amount"];
        } else {
            echo 0;
        }

    }

    /**
     * get most played card
     * @access public
     * @return void
     * @example ajax/mostPlayedCards
     * @author Luca Stanger
     */
    function mostPlayedCardsAction() {
        $lobby = Session::get("lobby");

        $returnArray = array();

        if (Vote::getMostPlayedCards($lobby, $returnArray)) {
            echo $returnArray[0];
        } else {
            echo 0;
        }
    }
    /**
     * Stores an Issue into the database
     * @access public
     * @example ajax/storeIssue
     * @return void
     * @author Luca Stanger
     */
    function storeIssueAction() {
        $issue = new Issue($_GET["id"], $_GET["title"], $_GET["body"]);
        $issue->saveToLobbyId($_SESSION["lobby"]);
    }

    /**
     *
     * @access public
     * @example ajax/getParticipants
     * @return void
     * @author Luca Stanger
     */
    function getParticipantsAction() {
        $lobbyid = $_GET["idlobby"];

        $returnArray = array();

        Participants::getParticipantsByLobby($lobbyid, $returnArray);

        foreach ($returnArray as $key=>$item) {
            $returnArray[$key] = (array) $item;
        }

        echo json_encode($returnArray);
    }

    /**
     *
     * @access public
     * @example ajax/getCurrentIssue
     * @return void
     * @author Luca Stanger
     */
    function getCurrentIssueAction() {
        $lobbyid = $_GET["idlobby"];

        $returnArray = array();

        Issue::getActiveIssueByLobbyId($lobbyid, $returnArray);

        foreach ($returnArray as $key=>$item) {
            $returnArray[$key] = (array) $item;
        }

        echo json_encode($returnArray);
    }

    /**
     *
     * @access public
     * @example ajax/vote
     * @return void
     * @author Luca Stanger
     */
    function voteAction() {
        $vote = $_GET["value"];
        $user = Session::get("user")->getId();
        $lobby = Session::get("lobby");

        Vote::vote($lobby, $user, $vote);
    }

}