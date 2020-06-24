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

    public function insertarPublicacion($contenido_gratuito, $numero, $id_tipo_publicacion)
    {

        $int_contenido_gratuito = $contenido_gratuito ? 1 : 0;

        return $this
            ->conexion
            ->insertQuery("insert into publicacion (contenido_gratuito, numero, estado_registro, fecha, id_tipo_publicacion, id_estado) value ($int_contenido_gratuito, $numero, 1, now(), $id_tipo_publicacion, (select id from estado where codigo = '10'))");
    }

    public function getPublicacion($id)
    {
        $publicacion = $this
            ->conexion
            ->querySingleRow("select id, contenido_gratuito, numero, estado_registro, fecha, id_tipo_publicacion, id_estado from publicacion where id = $id");

        return new Publicacion(
            $publicacion["id"],
            $publicacion["contenido_gratuito"],
            $publicacion["numero"],
            $publicacion["estado_registro"],
            date($publicacion["fecha"]),
            $publicacion["id_tipo_publicacion"],
            $publicacion["id_estado"]
        );
    }
}