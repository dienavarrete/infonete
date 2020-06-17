<?php


class Usuario
{
    private $id;
    private $nombre;

    /**
     * Usuario constructor.
     * @param int $id
     * @param str $nombre
     */
    public function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return str
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param str $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    /**
     * @param Usuario $usuario
     *
     * @return array
     */
    public static function toArrayMap($usuario) {
        if(isset($usuario)) {
            return array(
                "id" => $usuario->getId(),
                "nombre" => $usuario->getNombre()
            );
        } else {
            return array();
        }
    }


}