<?php

require_once "model/RolUsuario.php";

class RolUsuarioDAO
{
    private $conexion;

    /**
     * RolUsuario constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }


    public function getRoles()
    {
        $roles = $this
            ->conexion
            ->query("select id, codigo, descripcion from rol");

        $result = array();

        foreach ($roles as $k => $rol) {
            array_push($result, new RolUsuario(
                $rol["id"],
                $rol["codigo"],
                $rol["descripcion"]));
        }

        return $result;
    }

}