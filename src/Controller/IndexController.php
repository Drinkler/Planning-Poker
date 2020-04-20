<?php


namespace PlanningPoker\Controller;

use PlanningPoker\Library\NotFoundExpression;
use PlanningPoker\Model\User;


class IndexController implements Controller
{
    protected $view;

    public function setView(\PlanningPoker\Library\View $view) {
        $this->view = $view;
    }

    public function indexAction() {
        $this->view->setVars([

        ]);
    }

    public function loginAction() {
        User::login($_POST['email'], $_POST['password']);
    }

    public function showUserAction() {
        $uid = (int)(isset($_GET['uid']) ? $_GET['uid'] : '');

        if (!$uid) {
            throw new NotFoundExpression();
        }

        $user = User::findFirst($uid);

        if (!$user instanceof User) {
            throw new NotFoundException();
        }

        $this->view->setVars(['name' => $user->name]);
    }
}