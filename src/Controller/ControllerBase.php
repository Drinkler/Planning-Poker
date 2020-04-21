<?php

namespace PlanningPoker\Controller;

/**
 * Class ControllerBase:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
abstract class ControllerBase implements Controller
{
    protected $view;

    public function indexAction() {

    }

    public function setView(\PlanningPoker\Library\View $view) {
        $this->view = $view;
    }
}