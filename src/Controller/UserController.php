<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\Flash;
use PlanningPoker\Library\Session;
use PlanningPoker\Library\Text;
use PlanningPoker\Model\User;

/**
 * Class UserController:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
class UserController extends ControllerBase implements Controller
{
    /**
     * Logs in the posted user
     * @access public
     * @example user/login
     * @return void
     * @author Luca Stanger
     */
    public function loginAction()
    {
        $tRet = User::login($_POST['email'], $_POST['password']);
        if ($tRet) {
            Flash::success(Text::get("USER_LOGIN_SUCCESS"));
        } else {
            Flash::danger(Text::get("USER_LOGIN_EXCEPTION"));
        }
    }

    /**
     * Logs out the current user
     * @access public
     * @example user/logout
     * @return void
     * @author Luca Stanger
     */
    public function logoutAction()
    {
        $tRet = User::logout();
        if ($tRet) {
            Flash::success(Text::get("LOGOUT_USER_SUCCESSFUL"));
        } else {
            Flash::warning(Text::get("USER_LOGOUT_INVALID"));
        }
    }

    /**
     * Creates a new user
     * Adds confirmation parameters to the view
     * @access public
     * @example user/create
     * @return void
     * @author Luca Stanger
     */
    public function createAction()
    {
        $vars = array();
        if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $tRet = User::create($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], PASSWORD_DEFAULT, $vars);
            if ($tRet) {
                $this->view->setVars($vars);
                Flash::success(Text::get("REGISTER_USER_CREATED"));
            } else {
                Flash::danger(Text::get($vars["error"]));
            }
        } else {
            Flash::danger(Text::get("VALIDATE_REQUIRED_RULE"));
        }
    }

    /**
     * Confirms the user which is stored inside the view
     * @access public
     * @example user/confirm
     * @return void
     * @author Luca Stanger
     */
    public function confirmAction()
    {
        $tRet = User::confirm($this->view->basic_params[2], $this->view->basic_params[3]);
        if ($tRet) {
            Flash::success(Text::get("LOGIN_USER_CONFIRMED"));
        } else {
            Flash::warning(Text::get("USER_CONFIRMATION_INVALID"));
        }
    }

    /**
     * Sets the vars for profile view
     * @access public
     * @example user/profile
     * @return void
     * @author Luca Stanger
     * @author Florian Drinkler
     */
    public function profileAction()
    {
        $currentUser = Session::get("user");
        $user = array(
            "user" => $currentUser,
            "avatar" => User::get_gravatar($currentUser->getEmail(), $s = 200)
        );

        $this->view->setVars($user);
    }

    /**
     *
     */
    public function deleteAction() {
        $tRet = User::delete();
        $this->logoutAction();
        if ($tRet) {
            Flash::info(Text::get("USER_DELETE_SUCCESS"));
        } else {
            Flash::warning(Text::get("USER_DELETE_FAILED"));
        }
    }
}
