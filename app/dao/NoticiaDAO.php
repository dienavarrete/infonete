<?php
require_once "model/Noticia.php";

class NoticiaDAO
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

    public function insertarNoticia($titulo, $contenido, $id_seccion, $id_usuario)
    {
        return $this
            ->conexion
            ->insertQuery("insert into noticia (titulo, contenido, estado_registro, id_seccion, id_contenidista, id_localidad, id_estado) value ('$titulo', '$contenido', 1, $id_seccion, $id_usuario, null, 1)");
    }

    /**
     * @param $id_seccion
     * @return Noticia[]
     */
    public function getNoticias($id_seccion)
    {
        $noticias = $this
            ->conexion
            ->query("select id, titulo, contenido, estado_registro, id_seccion, id_contenidista, id_localidad, id_estado from noticia where id_seccion = $id_seccion");

        $result = array();

        foreach ($noticias as $k => $noticia) {
            array_push($result, new Noticia(
                $noticia["id"],
                $noticia["titulo"],
                $noticia["contenido"],
                $noticia["estado_registro"],
                $noticia["id_seccion"],
                $noticia["id_contenidista"],
                $noticia["id_localidad"],
                $noticia["id_estado"]
            ));
        }

        return $result;
    }
}