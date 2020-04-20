<?php


namespace PlanningPoker\Controller;


class SessionsController implements Controller
{
    protected $view;

    public function setView(\PlanningPoker\Library\View $view) {
        $this->view = $view;
    }

    public function indexAction() {
        $this->view->setVars([

        ]);
    }

    public function showAction() {

    }

}