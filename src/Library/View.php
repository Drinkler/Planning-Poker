<?php

namespace PlanningPoker\Library;

/**
 * Class View:
 *
 * @package PlanningPoker\Library
 * @author Luca Stanger
 */
class View
{
    public $path, $controller, $action, $vars = array();
    private $_linkTags, $_scriptTags;

    public $basic_css = array();
    public $basic_js = array();
    public $basic_params = array();


    public function __construct($path, $controller, $action) {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;

        $this->basic_css = array(
            'bootstrap/css/bootstrap.min.css',
            'fonts/font-awesome.min.css',
            'fonts/ionicons.min.css',
            'css/Features-Clean.css',
            'css/Footer-Clean.css',
            'css/Login-Form-Clean.css',
            'css/Navigation-with-Button.css',
            'css/Registration-Form-with-Photo.css',
            'css/Social-Icons.css',
            'css/styles.css',
            'css/Testimonials.css'
        );

        $this->basic_js = array(
            'js/jquery.min.js',
            'bootstrap/js/bootstrap.min.js'
        );
    }

    public function render() {
        $fileName = $this->path.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$this->action.'.phtml';

        if (!file_exists($fileName)) {
            Redirect::to(404);
        }

        $this->addCSS($this->basic_css);
        $this->addJS($this->basic_js);

        $this->getFile(DEFAULT_HEADER_PATH);
        $this->getFile($this->controller.DIRECTORY_SEPARATOR.$this->action);
        $this->getFile(DEFAULT_FOOTER_PATH);
    }

    /**
     * render function for instant redirect pages
     */
    public function renderWithoutHeaderAndFooter() {
        $fileName = $this->path.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$this->action.'.phtml';

        if (!file_exists($fileName)) {
            Redirect::to(404);
        }

        $this->addCSS($this->basic_css);
        $this->addJS($this->basic_js);

        $this->getFile($this->controller.DIRECTORY_SEPARATOR.$this->action);
    }

    public function setVars(array $_vars) {
        foreach ($_vars as $key => $val) {
            $this->vars[$key] = $val;
        }
    }

    public function addParams($params) {
        if (!is_array($params)) {
            $params = (array) $params;
        }
        $this->basic_params = $params;
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
        $filename = VIEW_PATH . $filepath . ".phtml";
        if (file_exists($filename)) {
            require $filename;
        }
    }

}