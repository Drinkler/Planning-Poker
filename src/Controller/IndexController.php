<?php


namespace PlanningPoker\Controller;

use PlanningPoker\Library\NotFoundExpression;
use PlanningPoker\Model\User;


class IndexController extends ControllerBase implements Controller
{

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