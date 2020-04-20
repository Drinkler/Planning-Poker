<?php


namespace PlanningPoker\Controller;

// Interface for instanceof checks
interface Controller
{
    public function setView(\PlanningPoker\Library\View $view);
}