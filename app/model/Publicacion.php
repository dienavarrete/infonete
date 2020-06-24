<?php


class Publicacion
{
    private $id;
    private $contenido_gratuito;
    private $numero;
    private $estado_registro;
    private $fecha;
    private $id_tipo_publicacion;
    private $id_estado_publicacion;
    private $secciones;

    /**
     * Publicacion constructor.
     * @param $id
     * @param $contenido_gratuito
     * @param $numero
     * @param $estado_registro
     * @param $fecha
     * @param $id_tipo_publicacion
     * @param $id_estado_publicacion
     */
    public function __construct($id, $contenido_gratuito, $numero, $estado_registro, $fecha, $id_tipo_publicacion, $id_estado_publicacion)
    {
        $this->id = $id;
        $this->contenido_gratuito = $contenido_gratuito;
        $this->numero = $numero;
        $this->estado_registro = $estado_registro;
        $this->fecha = $fecha;
        $this->id_tipo_publicacion = $id_tipo_publicacion;
        $this->id_estado_publicacion = $id_estado_publicacion;
    }

    /**
     * @return mixed
     */
    public function getEstadoRegistro()
    {
        return $this->estado_registro;
    }

    /**
     * @param mixed $estado_registro
     */
    public function setEstadoRegistro($estado_registro)
    {
        $this->estado_registro = $estado_registro;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContenidoGratuito()
    {
        return $this->contenido_gratuito;
    }

    /**
     * @param mixed $contenido_gratuito
     */
    public function setContenidoGratuito($contenido_gratuito)
    {
        $this->contenido_gratuito = $contenido_gratuito;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getIdTipoPublicacion()
    {
        return $this->id_tipo_publicacion;
    }

    /**
     * @param mixed $id_tipo_publicacion
     */
    public function setIdTipoPublicacion($id_tipo_publicacion)
    {
        $this->id_tipo_publicacion = $id_tipo_publicacion;
    }

    /**
     * @return mixed
     */
    public function getIdEstadoPublicacion()
    {
        return $this->id_estado_publicacion;
    }

    /**
     * @param mixed $id_estado_publicacion
     */
    public function setIdEstadoPublicacion($id_estado_publicacion)
    {
        $this->id_estado_publicacion = $id_estado_publicacion;
    }

    /**
     * @return mixed
     */
    public function getSecciones()
    {
        return $this->secciones;
    }

    /**
     * @param mixed $secciones
     */
    public function setSecciones($secciones)
    {
        $this->secciones = $secciones;
    }

    /**
     * @param Publicacion $publicacion
     *
     * @return array
     */
    public static function toArrayMap($publicacion)
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