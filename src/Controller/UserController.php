<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\Flash;
use PlanningPoker\Model\User;

/**
 * Class UserController:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
class UserController extends ControllerBase
{
    /**
     * Logs in the posted user
     * @access public
     * @example user/login
     * @return void
     * @author Luca Stanger
     */
    public function loginAction() {
        User::login($_POST['email'], $_POST['password']);
        Flash::info("Erfolgreich angemeldet!");
    }

    /**
     * Logs out the current user
     * @access public
     * @example user/logout
     * @return void
     * @author Luca Stanger
     */
    public function logoutAction() {
        User::logout();
        Flash::info("Erfolgreich abgemeldet!");
    }

    /**
     * Creates a new user
     * Adds confirmation parameters to the view
     * @access public
     * @example user/create
     * @return void
     * @author Luca Stanger
     */
    public function createAction() {
        $vars = User::create($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
        $this->view->setVars($vars);
        Flash::success("Account wurde erfolgreich erstellt!");
    }

    /**
     * Confirms the user which is stored inside the view
     * @access public
     * @example user/confirm
     * @return void
     * @author Luca Stanger
     */
    public function confirmAction() {
        User::confirm($this->view->basic_params[2], $this->view->basic_params[3]);
        Flash::success("Account wurde bestätigt!");
    }

}
