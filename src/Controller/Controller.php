<?php

namespace PlanningPoker\Controller;

use PlanningPoker\Library\View;

/**
 * Interface Controller:
 *
 * @package PlanningPoker\Controller
 * @author Luca Stanger
 */
interface Controller
{
    /**
     * @param View $view
     * @return mixed
     */
    public function setView(View $view);
}