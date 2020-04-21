<?php


namespace PlanningPoker\Controller;


abstract class ControllerBase implements Controller
{
    protected $view;

    public function indexAction() {

    }

    public function setView(\PlanningPoker\Library\View $view) {
        $this->view = $view;
    }
}