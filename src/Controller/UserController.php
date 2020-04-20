<?php


namespace PlanningPoker\Controller;


use PlanningPoker\Model\User;

class UserController extends ControllerBase implements Controller
{
    public function loginAction() {
        User::login($_POST['email'], $_POST['password']);
    }

    public function logoutAction() {
        User::logout();
    }

    public function createAction() {
        User::create($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
    }

}