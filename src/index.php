<?php
use PlanningPoker\Controller\Controller;
use PlanningPoker\Library\NotFoundExpression;
use PlanningPoker\Library\Redirect;
use PlanningPoker\Library\Session;
use PlanningPoker\Library\View;

require_once "init.php";


/**
 * Eigenes kleines PHP Framework gebaut
 * Quelle: https://poe-php.de/oop/mvc-einfuehrung-framework
 */

spl_autoload_register(function ($class_name) {
    if (substr($class_name, 0, 14) !== 'PlanningPoker\\') {
        // Not our business
        return;
    }
    $fileName = __DIR__.'/'.str_replace('\\', DIRECTORY_SEPARATOR, substr($class_name, 14)).'.php';

    if (file_exists($fileName)) {
        include $fileName;
    }
});

Session::init();

// get requested url
$url = (isset($_GET['_url']) ? $_GET['_url'] : '');
$urlParts = explode('/', $url);

// build the controller class
$controllerName = (isset($urlParts[0]) && $urlParts[0] ? $urlParts[0] : 'index');
$controllerClassName = '\\PlanningPoker\\Controller\\'.ucfirst($controllerName).'Controller';

// build the action method
$actionName = (isset($urlParts[1]) && $urlParts[1] ? $urlParts[1] : 'index');
$actionMethodName = ucfirst($actionName).'Action';

try {
    if (!class_exists($controllerClassName)) {
        throw new NotFoundExpression();
    }

    $controller = new $controllerClassName();

    if (!$controller instanceof Controller || !method_exists($controller, $actionMethodName)) {
        throw new NotFoundExpression();
    }

    $params = array();
    for ($i = 2; $i < count($urlParts); $i++) {
        $params[$i] = $urlParts[$i];
    }

    $view = new View(__DIR__.DIRECTORY_SEPARATOR.'views', $controllerName, $actionName);
    $controller->setView($view);

    $view->addParams($params);

    $tRet = $controller->$actionMethodName();

    // If the submitted url is an ajax request, dont render the view
    if ((substr($url, 0, 5) !== 'ajax/')) {
        if (!$tRet) {
            Redirect::to("../index/index");
        }
        // Added specific cases for login and logout
        if ($url == "user/logout" || $url == "user/login" || $url == "user/confirm" || $url == "user/delete" || $url == "lobby/action") {
            $view->renderWithoutHeaderAndFooter();
        } else {
            $view->render();
        }
    }
}  catch (PlanningPoker\Library\NotFoundExpression $e) {
    http_response_code(404);
    //echo 'Page not found: '.$controllerClassName.'::'.$actionMethodName;
    Redirect::to("../index/notFound");
} catch (\Exception $e) {
    http_response_code(500);
    echo 'Exception: <b>'.$e->getMessage().'</b><br><pre>'.$e->getTraceAsString().'</pre>';
}