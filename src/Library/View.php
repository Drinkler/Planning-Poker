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


    /**
     * View constructor.
     * @param $path
     * @param $controller
     * @param $action
     * @author Luca Stanger
     * @return void
     */
    public function __construct($path, $controller, $action) {
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;

        //'assets/'
        $this->basic_css = array(
            'bower_components/bootstrap/dist/css/bootstrap.min.css',
            'bower_components\components-font-awesome\css\fontawesome.min.css',
            'bower_components\components-font-awesome\css\brands.min.css',
            'bower_components\components-font-awesome\css\all.min.css',
            'bower_components\components-font-awesome\css\regular.min.css',
            'bower_components\components-font-awesome\css\solid.min.css',
            'bower_components\components-font-awesome\css\svg-with-js.min.css',
            'bower_components\components-font-awesome\css\v4-shims.min.css',
            'assets/fonts/ionicons.min.css',
            'assets/css/Features-Clean.css',
            'assets/css/Footer-Clean.css',
            'assets/css/Login-Form-Clean.css',
            'assets/css/Navigation-with-Button.css',
            'assets/css/Registration-Form-with-Photo.css',
            'assets/css/Social-Icons.css',
            'assets/css/styles.css',
            'assets/css/Testimonials.css'
        );

        $this->basic_js = array(
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/bootstrap/dist/js/bootstrap.min.js',
            'assets/script/ajax.js'
        );
    }

    /**
     * Render: renders the submitted view
     * @author Luca Stanger
     * @return void
     */
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
     * RenderWithoutHeaderAndFooter: renders the submitted view without header and footer
     * @author Luca Stanger
     * @return void
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

    /**
     * SetVars: sets variables to the view
     * @param array $_vars
     * @author Luca Stanger
     * @return void
     */
    public function setVars(array $_vars) {
        foreach ($_vars as $key => $val) {
            $this->vars[$key] = $val;
        }
    }

    /**
     * AddParams: adds additional parameters to the view
     * @param $params
     * @author Luca Stanger
     * @return void
     */
    public function addParams($params) {
        if (!is_array($params)) {
            $params = (array) $params;
        }
        $this->basic_params = $params;
    }

    /**
     * AddCSS: adds css files to the view
     * @param $files
     * @author Luca Stanger
     * @return void
     */
    public function addCSS($files) {
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach ($files as $file) {
            //if (file_exists(APP_ASSETS . $file)) {}
            $this->_linkTags .= '<link type="text/css" rel="stylesheet" href="' . $this->makeURL($file) . '" />' . "\n";
        }
    }

    /**
     * AddJS: adds JS files to the view
     * @param $files
     * @author Luca Stanger
     * @return void
     */
    public function addJS($files) {

        // Cast the value of $files to type array if it is not already.
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach ($files as $file) {

            // Check that the file exists in the public directory, creating the
            // <script> tag if it true.
            //if (file_exists(APP_ASSETS . $file)) {}
            $this->_scriptTags .= '<script type="text/javascript" src="' . $this->makeURL($file) . '"></script>' . "\n";
        }
    }

    /**
     * MakeURL: prettifies the submitted path and makes it accessible for mvc
     * @param string $path
     * @author Luca Stanger
     * @return string
     */
    public function makeURL($path = "") {
        if (is_array($path)) {
            return(APP_URL . implode("/", $path));
        }
        return(APP_URL . $path);
    }

    /**
     * GetJS: gets all js files contained by the view
     * @author Luca Stanger
     * @return mixed
     */
    public function getJS() {
        return($this->_scriptTags);
    }

    /**
     * GetCSS: gets all css files contained by the view
     * @author Luca Stanger
     * @return mixed
     */
    public function getCSS() {
        return($this->_linkTags);
    }

    /**
     * GetFile: requires the submitted file
     * @param $filepath
     * @author Luca Stanger
     * @return void
     */
    public function getFile($filepath) {
        $filename = VIEW_PATH . $filepath . ".phtml";
        if (file_exists($filename)) {
            require $filename;
        }
    }
    /**
     * Escape HTML: Converts all applicable characters to HTML entities.
     * @param string $string
     * @author Luca Stanger
     * @return string
     */
    public function escapeHTML($string) {
        return(htmlentities($string, HTMLENTITIES_FLAGS, HTMLENTITIES_ENCODING, HTMLENTITIES_DOUBLE_ENCODE));
    }


}