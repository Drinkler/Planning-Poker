<?php


namespace PlanningPoker\Controller;


use PlanningPoker\Model\User;

class UserController implements Controller
{
    protected $view;

    public function setView(\PlanningPoker\Library\View $view) {
        $this->view = $view;
    }

    public function loginAction() {
        User::login($_POST['email'], $_POST['password']);
    }

    public function logoutAction() {
        User::logout();
    }

    public function indexAction() {
        $this->view->setVars([

        ]);
    }
}