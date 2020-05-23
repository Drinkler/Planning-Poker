<?php

namespace PlanningPoker\Model;

/**
 * Class Vote
 * @package PlanningPoker\Model
 * @author Luca Stanger
 */
class Vote
{
    private $id, $user, $lobby, $vote;

    /**
     * Vote constructor.
     * @param $user
     * @param $issue
     * @param $vote
     * @author Luca Stanger
     */
    public function __construct($user, $lobby, $vote)
    {
        $this->user = $user;
        $this->lobby = $lobby;
        $this->vote = $vote;
    }

    /**
     * getAllIssuesSortedByLobby: Returns an array of issues
     * @param $lobby int contains the lobby id
     * @access public
     * @return
     * @author Luca Stanger
     */
    public static function getAllIssuesSortedByLobby($lobby) {
        // Prepare params
        $params = array(
            ':idlobby' => $lobby
        );

        // Prepare query
        $query = /** @lang SQL */
            "SELECT * FROM ";

        try {
            $result = (new PDOBase)->getPdo()->query($query, $params);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }


    }


}