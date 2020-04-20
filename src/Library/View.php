<?php


namespace PlanningPoker\Library;


use PlanningPoker\Utility\Redirect;

class View
{
    protected $path, $controller, $action, $vars = [];

    public function __construct($path, $controller, $action)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function render()
    {
        $fileName = $this->path.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$this->action.'.phtml';

        if (!file_exists($fileName)) {
            Redirect::to(404);
        }

        foreach ($this->vars as $key => $val) {
            $$key = $val;
        }

        include $fileName;
    }

    public function setVars(array $vars) {
        foreach ($vars as $key => $val) {
            $this->$vars[$key] = $val;
        }
    }

}