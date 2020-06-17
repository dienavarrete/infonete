<?php

require_once "model/Usuario.php";

class UsuarioDAO
{
    private $conexion;

    /**
     * UsuarioDAO constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }

    public function insertarUsuario($usuario, $password, $id_persona)
    {
        return $this
            ->conexion
            ->insertQuery("insert into usuario (usuario, password, id_persona) value ('$usuario', '$password', $id_persona)");
    }

    /**
     * @param string $usuario
     * @param string $password
     *
     * @return Usuario usuario
     */
    public function getUsuario($usuario, $password)
    {
        $usuario = $this
            ->conexion
            ->querySingleRow("select us.id, us.usuario, p.nombres nombres, p.apellido apellido,p.fecha_nacimiento from usuario us left join persona p on us.id_persona = p.id where usuario = '$usuario' and password = '$password'");

        return new Usuario(
            $usuario["id"],
            $usuario["usuario"],
            $usuario["nombres"],
            $usuario["apellido"],
            date($usuario["fecha_nacimiento"]));
    }
}