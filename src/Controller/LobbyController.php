<?php

namespace PlanningPoker\Controller;

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
     * @return bool
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
        return true;
    }

    /**
     * Creates a lobby
     * @access public
     * @example lobby/create
     * @return bool
     * @author Luca Stanger
     */
    public function createAction()
    {
        if (Session::get("signed_in")) {
            $user = Session::get("user");
            if ($_POST["lobbyName"] == "") {
                return false;
            }
            Lobby::create($_REQUEST["lobbyName"], (int) $_REQUEST["cards"], (int) $user->getId());
            Flash::success(Text::get("REGISTER_LOBBY_CREATED"));
            return true;
        } else {
            Flash::warning(Text::get("USER_LOGIN_REQUIRED"));
            return false;
        }
    }

    /**
     * Joins or deletes a lobby
     * @access public
     * @example lobby/action
     * @return bool
     * @author Luca Stanger
     * @author Florian Drinkler
     */
    public function lobbyAction() {
        // Check if user is logged in
        $user = Session::get("user");

        if (!empty($user)) {
            // Prepare params
            $params = array(
                ":idlobby" => (isset($_POST["lobbyid"]) && $_POST["lobbyid"] ? $_POST["lobbyid"] : null),
                ":iduser" => Session::get("user")->getId(),
            );

            if (isset($_POST['action'])) {
                if ($_POST['action'] == 'Join') {
                    $message = array();
                    if (Lobby::join($params, $message)) {
                        Flash::success("Joined");
                    } else {
                        Flash::danger($message["error"]);
                        return false;
                    }
                } else if ($_POST['action'] == 'Delete') {
                    Lobby::deleteById($params[":idlobby"]);
                    Redirect::to("../lobby/sessions");
                    return true;
                }
            } else {
                return false;
            }

            $tRet = array();
            // Find creator id for this lobby
            if (Lobby::getCreatorByLobbyID($params[":idlobby"], $tRet)) {
                $params[":idcreator"] = $tRet[0][0];
            }
            // Find card set for this lobby
            if (Lobby::getCardsByLobbyID($params[":idlobby"], $tRet)) {
                $params[":cards"] = $tRet[0][0];
            }

            $this->view->setVars($params);
            return true;
        } else {
            Flash::danger("You need to be logged in!");
            return false;
        }
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
            Flash::success("SUCCESSFUL_DELETED");

            Redirect::to("lobby/index");
        } else {
            Flash::danger("NOT DELETED");
        }
    }
}
