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
        $estados = $this
            ->conexion
            ->query("select id, codigo, descripcion from estado");

        $result = array();

        foreach ($estados as $k => $estado) {
            array_push($result, new RolUsuario(
                $estado["id"],
                $estado["codigo"],
                $estado["descripcion"]));
        }

        return $result;
    }

}