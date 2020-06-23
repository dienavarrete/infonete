<?php

require_once "excepciones/UnauthorizedException.php";
require_once "excepciones/UserLoggedException.php";

class SessionHelper
{
    public static function checkSesion()
    {
        if (!isset($_SESSION['usuario'])) {
            throw new UnauthorizedException("Tenés que iniciar sesión para poder realizar esta acción");
        }
    }

    public static function checkNoSesion()
    {
        if (isset($_SESSION['usuario'])) {
            throw new UserLoggedException("Ya existe sesión iniciada");
        }
    }


    public static function rolOneOf(array $array)
    {
        self::checkSesion();
        $codigo_rol = $_SESSION['usuario']["rol_usuario"]["codigo"];
        if (!in_array($codigo_rol, $array)) {
            throw new UnauthorizedException("No tenés permisos suficientes para poder realizar esta acción");
        }
    }
}