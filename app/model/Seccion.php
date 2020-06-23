<?php


class Seccion
{
    private $id;
    private $estado_registro;
    private $genero;
    private $id_publicacion;
    private $id_estado;
    private $noticias;

    /**
     * Seccion constructor.
     * @param $id
     * @param $estado_registro
     * @param GeneroSeccion $genero
     * @param $id_publicacion
     * @param $id_estado
     */
    public function __construct($id, $estado_registro, $genero, $id_publicacion, $id_estado)
    {
        $this->id = $id;
        $this->estado_registro = $estado_registro;
        $this->genero = $genero;
        $this->id_publicacion = $id_publicacion;
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
    public function getIdPublicacion()
    {
        return $this->id_publicacion;
    }

    /**
     * @param mixed $id_publicacion
     */
    public function setIdPublicacion($id_publicacion)
    {
        $this->id_publicacion = $id_publicacion;
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
    public function getNoticias()
    {
        return $this->noticias;
    }

    /**
     * @param mixed $noticias
     */
    public function setNoticias($noticias)
    {
        $this->noticias = $noticias;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @param Seccion $seccion
     *
     * @return array
     */
    public static function toArrayMap($seccion)
    {
        if (isset($seccion)) {
            return array(
                "id" => $seccion->getId(),
                "estado_registro" => $seccion->getEstadoRegistro(),
                "genero" => GeneroSeccion::toArrayMap($seccion->getGenero()),
                "id_publicacion" => $seccion->getIdPublicacion(),
                "id_estado" => $seccion->getIdEstado(),
                "noticias" => Noticia::toListArrayMap($seccion->getNoticias())
            );
        } else {
            return array();
        }
    }

    /**
     * @param Seccion[] $array
     * @return array
     */
    public static function toListArrayMap($array)
    {
        $r = array();

        foreach ($array as $seccion) {
            array_push($r, self::toArrayMap($seccion));
        }

        return $r;
    }

}