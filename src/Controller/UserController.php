<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Model\User;

class UserController extends ControllerBase
{
    public function loginAction() {
        User::login($_POST['email'], $_POST['password']);
    }

    public function logoutAction() {
        User::logout();
    }

    public function createAction() {
        $vars = User::create($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
        $this->view->setVars($vars);
    }

    public function confirmAction() {
        User::confirm($this->view->basic_params[2], $this->view->basic_params[3]);
    }

}
