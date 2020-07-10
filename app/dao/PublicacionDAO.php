<?php

require_once "model/Publicacion.php";
require_once "model/Estado.php";

class PublicacionDAO
{
    private $conexion;

    /**
     * UsuarioDAO constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }

    public function insertarPublicacion($contenido_gratuito, $nombre, $numero, $id_tipo_publicacion)
    {
        $flag = strtolower($contenido_gratuito) == 'true' ? 1 : 0;

        return $this
            ->conexion
            ->insertQuery("insert into publicacion (nombre, contenido_gratuito, numero, estado_registro, fecha, id_tipo_publicacion, id_estado) value ('$nombre', $flag, $numero, 1, now(), $id_tipo_publicacion, (select id from estado where codigo = '10'))");
    }

    public function updateEstadoPublicacion($id_estado, $id_publicacion)
    {
        return $this
            ->conexion
            ->insertQuery("update publicacion SET id_estado = $id_estado where id = $id_publicacion");
    }

    public function getPublicacion($id)
    {

        $publicacion = $this
            ->conexion
            ->querySingleRow("select p.id, contenido_gratuito, nombre, numero, estado_registro, fecha, id_tipo_publicacion, e.id id_estado, e.codigo codigo_estado, e.descripcion descripcion_estado from publicacion p inner join estado e on p.id_estado = e.id where p.id = $id");

        return new Publicacion(
            $publicacion["id"],
            $publicacion["contenido_gratuito"],
            $publicacion["nombre"],
            $publicacion["numero"],
            $publicacion["estado_registro"],
            date($publicacion["fecha"]),
            $publicacion["id_tipo_publicacion"],
            new Estado($publicacion["id_estado"], $publicacion["codigo_estado"], $publicacion["descripcion_estado"])
        );
    }

    public function getPublicaciones()
    {

        $result = array();
        $publicaciones = $this
            ->conexion
            ->query("select p.id, contenido_gratuito, nombre, numero, estado_registro, fecha, id_tipo_publicacion, e.id id_estado, e.codigo codigo_estado, e.descripcion descripcion_estado from publicacion p inner join estado e on p.id_estado = e.id");

        foreach ($publicaciones as $k => $publicacion) {
            array_push($result, new Publicacion(
                $publicacion["id"],
                $publicacion["contenido_gratuito"],
                $publicacion["nombre"],
                $publicacion["numero"],
                $publicacion["estado_registro"],
                date($publicacion["fecha"]),
                $publicacion["id_tipo_publicacion"],
                new Estado($publicacion["id_estado"], $publicacion["codigo_estado"], $publicacion["descripcion_estado"])
            ));
        }

        return $result;
    }
}