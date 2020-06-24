<?php

require_once "model/GeneroSeccion.php";

class GeneroSeccionDAO
{
    private $conexion;

    /**
     * GeneroSeccionDAO constructor.
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

    public static function toArrayMap()
    {
        
        if (isset($publicacion)) {
            return array(
                "id" => $publicacion->getId(),
                "contenido_gratuito" => $publicacion->getContenidoGratuito(),
                "numero" => $publicacion->getNumero(),
                "estado_registro" => $publicacion->getEstadoRegistro(),
                "fecha" => $publicacion->getFecha(),
                "id_tipo_publicacion" => $publicacion->getIdTipoPublicacion(),
                "id_estado_publicacion" => $publicacion->getIdEstadoPublicacion(),
                "secciones" => Seccion::toListArrayMap($publicacion->getSecciones())
            );
        } else {
            return array();
        }
    }


}