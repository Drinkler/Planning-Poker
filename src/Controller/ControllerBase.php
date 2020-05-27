<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\View;

/**
 * Class ControllerBase:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
abstract class ControllerBase implements Controller
{
    /**
     * Contains the current view
     * @var $view
     */
    protected $view;

    /**
     * index method for any controller class
     */
    public function indexAction() {
        return true;
    }

    /**
     * Sets the view of the current controller
     * @param View $view
     * @return mixed|void
     */
    public function setView(View $view) {
        $this->view = $view;
    }
}