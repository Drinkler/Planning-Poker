<?php


namespace PlanningPoker\Controller;


use PlanningPoker\Model\Lobby;

class LobbyController extends ControllerBase implements Controller
{
    public function sessionsAction() {
        $result = Lobby::findAll();

        if (!empty($result)) {
            $this->view->setVars($result);
        }
    }

}