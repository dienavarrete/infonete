<?php

require_once "model/GeneroSeccion.php";

class GeneroSeccionDao
{
    private $conexion;

    /**
     * GeneroSeccionDao constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }


    public function getGeneros()
    {
        $generos = $this
            ->conexion
            ->query("select id, codigo, descripcion from genero_seccion");

        $result = array();

        foreach ($generos as $k => $genero) {
            array_push($result, new GeneroSeccion(
                $genero["id"],
                $genero["codigo"],
                $genero["descripcion"]));
        }

        return $result;
    }


}