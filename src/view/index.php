<?php
require_once '../../vendor/autoload.php';
require_once './route/route.php';

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response\RedirectResponse;

session_start();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);


$route = $matcher->match($request);




if (!$route) {
    echo 'No hay Ruta';
} else {
    RenderControllers($route->handler, $request);
}


function RenderControllers($routeHandler, $request)
{
    $handlerData = $routeHandler;
    $controller = new $handlerData['controller'];
    $actionName = $handlerData['action'];
    $respond =  $controller->$actionName($request);
    // si no esta Definido false
    $needAuth = $handlerData['auth'] ?? false;
    $sessionUserId = $_SESSION['userId'] ?? null;
    RedirectionHttp($respond,$needAuth,$sessionUserId);
    echo $respond->getBody();
}


function RedirectionHttp($respond,$needAuth,$sessionUserId)
{
    if ($needAuth && !$sessionUserId) {
        echo 'Hola soy session ';
        $respond = new RedirectResponse('/login');
    }
    foreach ($respond->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s',$name,$value),false,$respond->getStatusCode());
        }
        
    }
}


