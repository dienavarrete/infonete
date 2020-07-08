<?php


class Usuario
{
    private $id;
    private $usuario;
    private $apellido;
    private $nombre;
    private $fecha_nacimiento;
    private $rol;
    private $suscripcion_activa;

    /**
     * Usuario constructor.
     * @param int $id
     * @param str $usuario
     * @param str $apellido
     * @param str $nombre
     * @param Date $fecha_nacimiento
     * @param RolUsuario $rol
     * @param $suscripcion_activa
     */
    public function __construct($id, $usuario, $apellido, $nombre, $fecha_nacimiento, $rol, $suscripcion_activa)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->rol = $rol;
        $this->suscripcion_activa = $suscripcion_activa;
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
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param str $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return str
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param str $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
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
     * @return Date
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param Date $fecha_nacimiento
     */
    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }


    /**
     * @return RolUsuario
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param RolUsuario $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function esContenidista() {
        return $this->getRol()->getCodigo() == '20';
    }

    public function esAdmin() {
        return $this->getRol()->getCodigo() == '10';
    }

    /**
     * @param Usuario $usuario
     *
     * @return array
     */
    public static function toArrayMap($usuario)
    {
        if (isset($usuario)) {
            return array(
                "id" => $usuario->getId(),
                "usuario" => $usuario->getUsuario(),
                "apellido" => $usuario->getApellido(),
                "nombre" => $usuario->getNombre(),
                "fecha_nacimiento" => $usuario->getFechaNacimiento(),
                "rol_usuario" => RolUsuario::toArrayMap($usuario->getRol()),
                "suscripcion_activa" => $usuario->getSuscripcionActiva(),
                "es_admin" => $usuario->esAdmin(),
                "es_contenidista" => $usuario->esContenidista(),
                "puede_generar_contenido" => $usuario->esAdmin() || $usuario->esContenidista()
            );
        } else {
            return array();
        }
    }

    /**
     * @return mixed
     */
    public function getSuscripcionActiva()
    {
        return $this->suscripcion_activa;
    }

    /**
     * @param mixed $suscripcion_activa
     */
    public function setSuscripcionActiva($suscripcion_activa)
    {
        $this->suscripcion_activa = $suscripcion_activa;
    }

}