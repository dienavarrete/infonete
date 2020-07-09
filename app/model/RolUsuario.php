<?php


class RolUsuario
{
    private $id;
    private $codigo;
    private $descripcion;

    /**
     * RolUsuario constructor.
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
     * @param RolUsuario $rol_usuario
     *
     * @return array
     */
    public static function toArrayMap($rol_usuario)
    {
        if (isset($rol_usuario)) {
            return array(
                "id" => $rol_usuario->getId(),
                "codigo" => $rol_usuario->getCodigo(),
                "descripcion" => $rol_usuario->getDescripcion()
            );
        } else {
            return array();
        }
    }

    
    public static function toListArrayMap($array)
    {
        $r = array();

        foreach ($array as $rol) {
            array_push($r, self::toArrayMap($rol));
        }

        return $r;
    }
}