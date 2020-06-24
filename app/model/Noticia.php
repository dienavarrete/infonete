<?php


class Noticia
{
    private $id;
    private $titulo;
    private $contenido;
    private $estado_registro;
    private $id_seccion;
    private $id_contenidista;
    private $id_localidad;
    private $id_estado;

    /**
     * Noticia constructor.
     * @param $id
     * @param $titulo
     * @param $contenido
     * @param $estado_registro
     * @param $id_seccion
     * @param $id_contenidista
     * @param $id_localidad
     * @param $id_estado
     */
    public function __construct($id, $titulo, $contenido, $estado_registro, $id_seccion, $id_contenidista, $id_localidad, $id_estado)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->estado_registro = $estado_registro;
        $this->id_seccion = $id_seccion;
        $this->id_contenidista = $id_contenidista;
        $this->id_localidad = $id_localidad;
        $this->id_estado = $id_estado;
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
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
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
    public function getIdSeccion()
    {
        return $this->id_seccion;
    }

    /**
     * @param mixed $id_seccion
     */
    public function setIdSeccion($id_seccion)
    {
        $this->id_seccion = $id_seccion;
    }

    /**
     * @return mixed
     */
    public function getIdContenidista()
    {
        return $this->id_contenidista;
    }

    /**
     * @param mixed $id_contenidista
     */
    public function setIdContenidista($id_contenidista)
    {
        $this->id_contenidista = $id_contenidista;
    }

    /**
     * @return mixed
     */
    public function getIdLocalidad()
    {
        return $this->id_localidad;
    }

    /**
     * @param mixed $id_localidad
     */
    public function setIdLocalidad($id_localidad)
    {
        $this->id_localidad = $id_localidad;
    }

    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->id_estado;
    }

    /**
     * @param mixed $id_estado
     */
    public function setIdEstado($id_estado)
    {
        $this->id_estado = $id_estado;
    }


    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @param Noticia $noticia
     *
     * @return array
     */
    public static function toArrayMap($noticia)
    {
        if (isset($noticia)) {
            return array(
                "id" => $noticia->getId(),
                "titulo" => $noticia->getTitulo(),
                "contenido" => $noticia->getContenido(),
                "estado_registro" => $noticia->getEstadoRegistro(),
                "id_seccion" => $noticia->getIdSeccion(),
                "id_contenidista" => $noticia->getIdContenidista(),
                "id_localidad" => $noticia->getIdLocalidad(),
                "id_estado" => $noticia->getIdEstado()
            );
        } else {
            return array();
        }
    }

    /**
     * @param Noticia[] $array
     * @return array
     */
    public static function toListArrayMap($array)
    {
        $r = array();

        foreach ($array as $noticia) {
            array_push($r, self::toArrayMap($noticia));
        }

        return $r;
    }

}