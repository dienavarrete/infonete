<?php

require_once "model/Estado.php";

class EstadoDao
{
    private $conexion;

    /**
     * EstadoDao constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }


    public function getEstados()
    {
        $estados = $this
            ->conexion
            ->query("select id, codigo, descripcion from estado");

        $result = array();

        foreach ($estados as $k => $estado) {
            array_push($result, new Estado(
                $estado["id"],
                $estado["codigo"],
                $estado["descripcion"]));
        }

        return $result;
    }

    


}