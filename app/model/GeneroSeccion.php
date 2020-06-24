<?php


class GeneroSeccion
{

    private $id;
    private $codigo;
    private $descripcion;

    /**
     * GeneroSeccion constructor.
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
     * @param GeneroSeccion $genero_publicacion
     *
     * @return array
     */
    public static function toArrayMap($genero_publicacion)
    {
        if (isset($genero_publicacion)) {
            return array(
                "id" => $genero_publicacion->getId(),
                "codigo" => $genero_publicacion->getCodigo(),
                "descripcion" => $genero_publicacion->getDescripcion()
            );
        } else {
            return array();
        }
    }

    public static function toListArrayMap($array)
    {
        $r = array();

        foreach ($array as $seccion) {
            array_push($r, self::toArrayMap($seccion));
        }

        return $r;
    }
}