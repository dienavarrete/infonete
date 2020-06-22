<?php

require_once "model/Usuario.php";
require_once "model/RolUsuario.php";

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
            ->insertQuery("insert into usuario (usuario, password, id_persona, id_rol) value ('$usuario', '$password', '$id_persona', (select id from rol where codigo = '30'))");
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
            ->querySingleRow("select us.id, us.usuario, p.nombres nombres, p.apellido apellido, p.fecha_nacimiento, r.codigo codigo_rol, r.descripcion descripcion_rol from usuario us left join persona p on us.id_persona = p.id inner join rol r on us.id_rol = r.id where usuario = '$usuario' and password = '$password'");

        return new Usuario(
            $usuario["id"],
            $usuario["usuario"],
            $usuario["nombres"],
            $usuario["apellido"],
            date($usuario["fecha_nacimiento"]),
            new RolUsuario($usuario["codigo_rol"], $usuario["descripcion_rol"])
        );
    }
}