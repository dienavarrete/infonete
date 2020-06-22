<?php

require_once("third-party/altorouter/AltoRouter.php");
require_once("ModuleInitializer.php");

session_start();

$router = new AltoRouter();
$moduleInitializer = new ModuleInitializer();

$router->map('GET', '/', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createInicioController();
    $controller->getIndex();
});

$router->map('GET', '/registro', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createRegistroController();
    $controller->getIndex();
});

$router->map('POST', '/registro', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createRegistroController();
    $controller->postIndex();
});

$router->map('POST', '/seccion/[i:id_seccion]/noticia', function ($id_seccion) use ($moduleInitializer) {
    $controller = $moduleInitializer->createNoticiaController();
    $controller->crearNoticia($id_seccion);
});

$router->map('GET', '/seccion/[i:id_seccion]/noticia', function ($id_seccion) use ($moduleInitializer) {
    $controller = $moduleInitializer->createNoticiaController();
    $controller->formularioNoticia($id_seccion);
});

$router->map('GET', '/noticia/[i:id]', function ($id) use ($moduleInitializer) {
    echo "ver noticia $id";
});


$router->map('GET', '/dashboard', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createDashboardController();
    $controller->getIndex();
});

$router->map('GET', '/login', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createLoginController();
    $controller->getIndex();
});

$router->map('POST', '/login', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createLoginController();
    $controller->postIndex();
});

$router->map('GET', '/logout', function () use ($moduleInitializer) {
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


