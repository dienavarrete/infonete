<?php

require_once "model/TipoPublicacion.php";

class TipoPublicacionDAO
{
    private $conexion;

    /**
     * TipoPublicacionDAO constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }

    public function getTiposPublicaciones()
    {
        $tipos_publicaciones = $this
            ->conexion
            ->query("select id, codigo, descripcion from tipo_publicacion");

        $result = array();

        foreach ($tipos_publicaciones as $k => $tipo_publicacion) {
            array_push($result, new TipoPublicacion(
                $tipo_publicacion["id"],
                $tipo_publicacion["codigo"],
                $tipo_publicacion["descripcion"]));
        }

        return $result;
    }

    public function getTipoPublicacion($id)
    {
        $tipo_publicacion = $this
            ->conexion
            ->querySingleRow("select id, codigo, descripcion from tipo_publicacion where id = $id");

        return new TipoPublicacion(
            $tipo_publicacion["id"],
            $tipo_publicacion["codigo"],
            $tipo_publicacion["descripcion"]);

    }
}