<?php

require_once("third-party/altorouter/AltoRouter.php");
require_once("ModuleInitializer.php");
require_once("helper/SessionHelper.php");

session_start();

$router = new AltoRouter();
$moduleInitializer = new ModuleInitializer();

$router->map('GET', '/', function () use ($moduleInitializer) {
    $controller = $moduleInitializer->createInicioController();
    $controller->getIndex();
});

$router->map('GET', '/registro', function () use ($moduleInitializer) {
    try {
        SessionHelper::checkNoSesion();
        $controller = $moduleInitializer->createRegistroController();
        $controller->getRegistroFormView();
    } catch (UserLoggedException $ex) {
        header("Location: /dashboard");
        exit();
    }
});

$router->map('POST', '/registro', function () use ($moduleInitializer) {
    try {
        SessionHelper::checkNoSesion();
        $controller = $moduleInitializer->createRegistroController();
        $controller->postIndex();
    } catch (UserLoggedException $ex) {
        header("Location: /dashboard");
        exit();
    }
});

$router->map('POST', '/secciones/[i:id_seccion]/noticias', function ($id_seccion) use ($moduleInitializer) {
    try {
        SessionHelper::rolOneOf(['10', '20']);
        $controller = $moduleInitializer->createNoticiaController();
        $controller->crearNoticia($id_seccion);
    } catch (UnauthorizedException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized');
    }
});

$router->map('GET', '/usuarios', function () use ($moduleInitializer) {
    
    try {
        SessionHelper::rolOneOf(['10']);
        $controller = $moduleInitializer->createUsuarioController();
        $controller->getUsuarios();
    } catch (EntityNotFoundException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        $controller = $moduleInitializer->createError404Controller();
        $controller->get404View();
    }
});

$router->map('GET', '/publicaciones', function () use ($moduleInitializer) {
    
    try {
        SessionHelper::rolOneOf(['10', '20']);
        $controller = $moduleInitializer->createPublicacionController();
        $controller->getPublicaciones();
    } catch (EntityNotFoundException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        $controller = $moduleInitializer->createError404Controller();
        $controller->get404View();
    }
});

$router->map('GET', '/publicaciones/[i:id]', function ($id) use ($moduleInitializer) {
    
    try {
        $controller = $moduleInitializer->createPublicacionController();
        $controller->getPublicacion($id);
    } catch (EntityNotFoundException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        $controller = $moduleInitializer->createError404Controller();
        $controller->get404View();
    }
});

$router->map('GET', '/crear-publicacion', function () use ($moduleInitializer) {
    
    try {
        SessionHelper::rolOneOf(['10', '20']);
        $controller = $moduleInitializer->createPublicacionController();
        $controller->crearPublicacionVista();
    } catch (UnauthorizedException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        $controller = $moduleInitializer->createError404Controller();
        $controller->get404View();
    }
});

$router->map('POST', '/publicaciones', function () use ($moduleInitializer) {
    try {
        SessionHelper::rolOneOf(['10', '20']);
        $controller = $moduleInitializer->createPublicacionController();
        echo $controller->crearPublicacion();
    } catch (EntityNotFoundException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request');
    } catch (UnauthorizedException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized');
    }
});

$router->map('POST', '/publicaciones/[i:publicacion]/secciones', function ($publicacion) use ($moduleInitializer) {
    try {
        SessionHelper::rolOneOf(['10', '20']);
        $controller = $moduleInitializer->createSeccionController();
        $controller->crearSeccion($publicacion);
    } catch (UnauthorizedException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized');
    }
});

$router->map('POST', '/publicaciones/[i:publicacion]/estado', function ($publicacion) use ($moduleInitializer) {
    try {
        SessionHelper::rolOneOf(['10', '20']);
        $controller = $moduleInitializer->createPublicacionController();
        echo $controller->updateStatusPublicacion($publicacion);
    } catch (UnauthorizedException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized');
    }
});

$router->map('POST', '/usuarios/[i:usuario]/rol', function ($usuario) use ($moduleInitializer) {
    try {
        SessionHelper::rolOneOf(['10']);
        $controller = $moduleInitializer->createUsuarioController();
        echo $controller->updateRolUsuario($usuario);
    } catch (UnauthorizedException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized');
    }
});

$router->map('GET', '/noticias/[i:id]', function ($id) use ($moduleInitializer) {
    try {
        $controller = $moduleInitializer->createNoticiaController();
        $controller->getNoticia($id);
    } catch (EntityNotFoundException $ex) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        $controller = $moduleInitializer->createError404Controller();
        $controller->get404View();
    }
});


$router->map('GET', '/dashboard', function () use ($moduleInitializer) {
    try {
        SessionHelper::checkSesion();
        $controller = $moduleInitializer->createDashboardController();
        $controller->getIndex();
    } catch (UnauthorizedException $ex) {
        header("Location: /login");
        exit();
    }
});

$router->map('GET', '/login', function () use ($moduleInitializer) {
    try {
        SessionHelper::checkNoSesion();
        $controller = $moduleInitializer->createLoginController();
        $controller->getIndex();
    } catch (UserLoggedException $ex) {
        header("Location: /dashboard");
        exit();
    }
});

$router->map('POST', '/login', function () use ($moduleInitializer) {
    try {
        SessionHelper::checkNoSesion();
        $controller = $moduleInitializer->createLoginController();
        $controller->postIndex();
    } catch (UserLoggedException $ex) {
        header("Location: /dashboard");
        exit();
    }
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
    $controller->get404View();
}


