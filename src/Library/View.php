<?php


namespace PlanningPoker\Library;

class View
{
    protected $path, $controller, $action, $vars = [];
    private $_linkTags, $_scriptTags;

    public function __construct($path, $controller, $action) {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function render() {
        $fileName = $this->path.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$this->action.'.phtml';

        if (!file_exists($fileName)) {
            Redirect::to(404);
        }

        foreach ($this->vars as $key => $val) {
            $$key = $val;
        }

        $this->getFile(DEFAULT_HEADER_PATH);
        require $fileName;
        $this->getFile(DEFAULT_FOOTER_PATH);
    }

    public function setVars(array $vars) {
        foreach ($vars as $key => $val) {
            $this->$vars[$key] = $val;
        }
    }

    public function addCSS($files) {
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach ($files as $file) {
            if (file_exists(APP_ASSETS . $file)) {
                $this->_linkTags .= '<link type="text/css" rel="stylesheet" href="' . $this->makeURL('assets/' . $file) . '" />' . "\n";
            }
        }
    }

    public function addJS($files) {

        // Cast the value of $files to type array if it is not already.
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach ($files as $file) {

            // Check that the file exists in the public directory, creating the
            // <script> tag if it true.
            if (file_exists(APP_ASSETS . $file)) {
                $this->_scriptTags .= '<script type="text/javascript" src="' . $this->makeURL('assets/' . $file) . '"></script>' . "\n";
            }
        }
    }

    public function makeURL($path = "") {
        if (is_array($path)) {
            return(APP_URL . implode("/", $path));
        }
        return(APP_URL . $path);
    }

    public function getJS() {
        return($this->_scriptTags);
    }

    public function getCSS() {
        return($this->_linkTags);
    }

    public function getFile($filepath) {
        $filename = VIEW_PATH . $filepath . ".php";
        if (file_exists($filename)) {
            require $filename;
        }
    }

}