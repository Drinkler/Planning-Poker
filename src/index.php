<?php
#https://poe-php.de/oop/mvc-einfuehrung-framework/6

session_start();

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
        throw new \PlanningPoker\Library\NotFoundExpression();
    }

    $controller = new $controllerClassName();

    if (!$controller instanceof \PlanningPoker\Controller\Controller || !method_exists($controller, $actionMethodName)) {
        throw new \PlanningPoker\Library\NotFoundExpression();
    }

    $view = new \PlanningPoker\Library\View(__DIR__.DIRECTORY_SEPARATOR.'views', $controllerName, $actionName);
    $controller->setView($view);

    $controller->$actionMethodName();
    $view->render();


}  catch (PlanningPoker\Library\NotFoundExpression $e) {
    http_response_code(404);
    echo 'Page not found: '.$controllerClassName.'::'.$actionMethodName;
} catch (\Exception $e) {
    http_response_code(500);
    echo 'Exception: <b>'.$e->getMessage().'</b><br><pre>'.$e->getTraceAsString().'</pre>';
}
?>
