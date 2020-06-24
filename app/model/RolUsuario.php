<?php


class RolUsuario
{
    private $codigo;
    private $descripcion;

    /**
     * RolUsuario constructor.
     * @param $codigo
     * @param $descripcion
     */
    public function __construct($codigo, $descripcion)
    {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
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
                "codigo" => $rol_usuario->getCodigo(),
                "descripcion" => $rol_usuario->getDescripcion()
            );
        } else {
            return array();
        }
    }
}