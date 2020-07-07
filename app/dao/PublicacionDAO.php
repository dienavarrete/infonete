<?php

require_once "model/Publicacion.php";

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
        return $this
            ->conexion
            ->insertQuery("insert into publicacion (nombre, contenido_gratuito, numero, estado_registro, fecha, id_tipo_publicacion, id_estado) value ( '$nombre',$contenido_gratuito, $numero, 1, now(), $id_tipo_publicacion, (select id from estado where codigo = '10'))");
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
            ->querySingleRow("select id, contenido_gratuito, nombre, numero, estado_registro, fecha, id_tipo_publicacion, id_estado from publicacion where id = $id");

        return new Publicacion(
            $publicacion["id"],
            $publicacion["contenido_gratuito"],
            $publicacion["nombre"],
            $publicacion["numero"],
            $publicacion["estado_registro"],
            date($publicacion["fecha"]),
            $publicacion["id_tipo_publicacion"],
            $publicacion["id_estado"]
        );
    }

    public function getPublicaciones()
    {
        $publicaciones = $this
            ->conexion
            ->query("select id, contenido_gratuito, nombre, numero, estado_registro, fecha, id_tipo_publicacion, id_estado from publicacion");

        $result = array();

        foreach ($publicaciones as $k => $publicacion) {
            array_push($result, new Publicacion(
                $publicacion["id"],
                $publicacion["contenido_gratuito"],
                $publicacion["nombre"],
                $publicacion["numero"],
                $publicacion["estado_registro"],
                date($publicacion["fecha"]),
                $publicacion["id_tipo_publicacion"],
                $publicacion["id_estado"]
            ));
        }

        return $result;
    }
}