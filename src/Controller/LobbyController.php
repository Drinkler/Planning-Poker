<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\Config;
use PlanningPoker\Library\Flash;
use PlanningPoker\Library\Session;
use PlanningPoker\Library\Text;
use PlanningPoker\Model\Lobby;

/**
 * Class LobbyController:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
class LobbyController extends ControllerBase implements Controller
{
    /**
     * Submits all active lobbies to the view
     * @access public
     * @example lobby/sessions
     * @return void
     * @author Luca Stanger
     */
    public function sessionsAction() {
        $result = Lobby::findAll();

        if (!empty($result)) {
            $this->view->setVars($result);
        }
    }

    /**
     * Creates a lobby
     * @access public
     * @example lobby/create
     * @return void
     * @author Luca Stanger
     */
    public function createAction() {
        if (Session::get("signed_in")) {
            Lobby::create($_REQUEST["lobbyName"], (int) $_REQUEST["cards"], (int) $_SESSION["iduser"]);
            Flash::success(Text::get("REGISTER_LOBBY_CREATED"));
        } else {
            Flash::warning(Text::get("USER_LOGIN_REQUIRED"));
        }
    }

    /**
     * Joins a lobby
     * @access public
     * @example lobby/join
     * @return void
     * @author Luca Stanger
     */
    public function joinAction() {

    }

}