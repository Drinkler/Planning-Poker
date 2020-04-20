<?php


namespace PlanningPoker\Controller;


abstract class ControllerBase implements Controller
{
    protected $view;

    public function indexAction() {
        $basic_css = array(
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
        $basic_js = array(
            'js/jquery.min.js',
            'bootstrap/js/bootstrap.min.js'
        );
        $this->view->addCSS($basic_css);
        $this->view->addJS($basic_js);
    }

    public function setView(\PlanningPoker\Library\View $view) {
        $this->view = $view;
    }
}