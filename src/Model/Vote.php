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
     * Vote: Saves a vote into the db
     * @param $lobby int contains the lobbyid
     * @param $user int contains the userid
     * @param $vote int contains the vote value
     * @return bool
     */
    public static function vote($lobby, $user, $vote) {
        // Prepare params
        $params = array(
          ':idlobby' => $lobby,
          ':iduser' => $user,
          ':vote' => $vote
        );

        // Prepare query
        $query = /** @lang SQL */
            "INSERT INTO vote (idlobby, iduser, vote) VALUES (:idlobby, :iduser, :vote)";

        self::deletePrevious($lobby, $user);

        try {
            (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    private static function deletePrevious($lobby, $user) {
        // Prepare params
        $params = array(
            ':idlobby' => $lobby,
            ':iduser' => $user
        );

        // Prepare query
        $query = /** @lang SQL */
            "DELETE FROM vote WHERE iduser = :iduser AND idlobby = :idlobby";

        try {
            (new PDOBase)->getPdo()->queryWithoutFetch($query, $params);
            return true;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * getAllVotesSortedByLobby: Returns an array of issues
     * @param $lobby int contains the lobby id
     * @access public
     * @return bool
     * @author Luca Stanger
     */
    public static function getAllVotesSortedByLobby($lobby, &$_returnArray = array()) {
        // Prepare params
        $params = array(
            ':idlobby' => $lobby
        );

        // Prepare query
        $query = /** @lang SQL */
            "SELECT * FROM ";

        try {
            $result = (new PDOBase)->getPdo()->query($query, $params);

            foreach ($result as $vote) {
                array_push($_returnArray, new Vote($vote["isuer"], $vote["idlobby"], $vote["vote"]));
            }

            return true;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}