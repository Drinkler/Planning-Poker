<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\Config;
use PlanningPoker\Library\Flash;
use PlanningPoker\Library\Redirect;
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
     * @author Florian Drinkler
     */
    public function sessionsAction()
    {
        $vars = array();

        if (isset($this->view->basic_params[2])) {
            Lobby::findByCreator($vars);
        } else {
            Lobby::findAll($vars);
        }

        if (!empty($vars)) {
            $this->view->setVars($vars);
        }
    }

    /**
     * Creates a lobby
     * @access public
     * @example lobby/create
     * @return void
     * @author Luca Stanger
     */
    public function createAction()
    {
        if (Session::get("signed_in")) {
            $user = Session::get("user");
            Lobby::create($_REQUEST["lobbyName"], (int) $_REQUEST["cards"], (int) $user->getId());
            Flash::success(Text::get("REGISTER_LOBBY_CREATED"));
        } else {
            Flash::warning(Text::get("USER_LOGIN_REQUIRED"));
        }
    }

    /**
     * Joins or deletes a lobby
     * @access public
     * @example lobby/action
     * @return void
     * @author Luca Stanger
     * @author Florian Drinkler
     */
    public function actionAction() {
        // Prepare params
        $params = array(
            ":idlobby" => (isset($_POST["lobbyid"]) && $_POST["lobbyid"] ? $_POST["lobbyid"] : null),
            ":iduser" => Session::get("user")->getId()
        );

        if ($_POST['action'] == 'Join') {
            # Lobby::join();

        } else if ($_POST['action'] == 'Delete') {
            Lobby::deleteById($params[":idlobby"]);
        }
    }

    /**
     * Joins a lobby
     * @access public
     * @example lobby/join
     * @return void
     * @author Luca Stanger
     * @author Florian Drinkler
     * @deprecated
     */
    public function joinAction()
    {
    }

    /**
     * Deletes a lobby
     * @access public
     * @example lobby/join
     * @return void
     * @author Luca Stanger
     * @author Florian Drinkler
     * @deprecated
     */
    public function deleteAction()
    {
        $_id = $this->view->basic_params[1];

        if (isset($_id)) {
            Lobby::deleteById($_id);
            //Flash::success(Text::get("SUCCESSFUL_DELETED"));
            Flash::success("SUCCESSFUL_DELETED");

            Redirect::to("lobby/index");
        } else {
            Flash::danger("NOT DELETED");
        }
    }
}
