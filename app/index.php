<?php

require_once("third-party/altorouter/AltoRouter.php");
require_once("ModuleInitializer.php");

session_start();

$router = new AltoRouter();

$router->map('GET', '/', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createInicioController();
    $controller->getIndex();
});

$router->map('GET', '/registro', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createRegistroController();
    $controller->getIndex();
});

$router->map('POST', '/registro', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createRegistroController();
    $controller->postIndex();
});


$router->map('GET', '/dashboard', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createDashboardController();
    $controller->getIndex();
});

$router->map('GET', '/login', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createLoginController();
    $controller->getIndex();
});

$router->map('POST', '/login', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createLoginController();
    $controller->postIndex();
});

$router->map('GET', '/logout', function () {
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createLogoutController();
    $controller->getIndex();
});

$match = $router->match();


if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    $moduleInitializer = new ModuleInitializer();
    $controller = $moduleInitializer->createError404Controller();
    $controller->get404();
}


