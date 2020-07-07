<?php


class Estado
{

    private $id;
    private $codigo;
    private $descripcion;

    /**
     * Estado constructor.
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
     * @param Estado $estado
     *
     * @return array
     */
    public static function toArrayMap($estado)
    {
        if (isset($estado)) {
            return array(
                "id" => $estado->getId(),
                "codigo" => $estado->getCodigo(),
                "descripcion" => $estado->getDescripcion()
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