<?php
require_once "model/Seccion.php";
require_once "model/GeneroSeccion.php";

class SeccionDAO
{
    private $conexion;

    /**
     * SeccionDAO constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }

    /**
     * @param $id_publicacion
     * @return Seccion[]
     */
    public function getSecciones($id_publicacion)
    {
        $secciones = $this
            ->conexion
            ->query("select s.id, estado_registro, id_genero, id_publicacion, id_estado, gs.id id_genero, gs.codigo codigo_genero, gs.descripcion descripcion_genero from seccion s inner join genero_seccion gs on s.id_genero = gs.id where id_publicacion = $id_publicacion");

        $result = array();

        foreach ($secciones as $k => $seccion) {
            array_push($result, new Seccion(
                $seccion["id"],
                $seccion["estado_registro"],
                new GeneroSeccion(
                    $seccion["id_genero"],
                    $seccion["codigo_genero"],
                    $seccion["descripcion_genero"]),
                $seccion["id_publicacion"],
                $seccion["id_estado"]
            ));
        }

        return $result;
    }

    public function insertarSeccion($id_genero, $id_publicacion)
    {
        // var_dump($id_genero, $id_publicacion);
        // die;
        return $this
            ->conexion
            ->insertQuery("insert into seccion (estado_registro, id_genero, id_publicacion, id_estado) value (1, $id_genero, $id_publicacion, (select id from estado where codigo = '10'))");
    }
}