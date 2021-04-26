<?php

use Aura\Router\RouterContainer;


$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();

$map->get('home', '/', [
    'controller' => 'Src\Controllers\HomeController',
    'action' => 'getViewHome',
    'auth' => true
]);
$map->post('addimghome', '/', [
    'controller' => 'Src\Controllers\HomeController',
    'action' => 'postAddImg',
    'auth' => true
]);
$map->get('login', '/login', [
    'controller' => 'Src\Controllers\LoginController',
    'action' => 'getViewLogin'
]);
$map->post('addlogin', '/login', [
    'controller' => 'Src\Controllers\LoginController',
    'action' => 'Intro'
]);
$map->get('logout', '/logout', [
    'controller' => 'Src\Controllers\HomeController',
    'action' => 'getLogout'
]);
$map->get('registrer', '/register', [
    'controller' => 'Src\Controllers\RegistrerController',
    'action' => 'getViewRegister'
]);
$map->post('addRegistrer', '/register', [
    'controller' => 'Src\Controllers\RegistrerController',
    'action' => 'AddUsers'
]);
$matcher = $routerContainer->getMatcher();
// $route = $matcher->match($request);

