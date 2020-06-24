<?php

class TipoPublicacion
{
    private $id;
    private $codigo;
    private $descripcion;

    /**
     * TipoPublicacion constructor.
     * @param $id
     * @param $codigo
     * @param $descripcion
     */
    public function __construct($id, $codigo, $descripcion)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
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
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param TipoPublicacion $tipo_publicacion
     *
     * @return array
     */
    public static function toArrayMap($tipo_publicacion)
    {
        if (isset($tipo_publicacion)) {
            return array(
                "id" => $tipo_publicacion->getId(),
                "codigo" => $tipo_publicacion->getCodigo(),
                "descripcion" => $tipo_publicacion->getDescripcion()
            );
        } else {
            return array();
        }
    }

    /**
     * @param TipoPublicacion[] $array
     * @return array
     */
    public static function toListArrayMap($array)
    {
        $r = array();

        foreach ($array as $tipo_publicacion) {
            array_push($r, self::toArrayMap($tipo_publicacion));
        }

        return $r;
    }

}