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

    public function insertarUsuario($nombre, $password)
    {
        return $this
            ->conexion
            ->insertQuery("insert into usuario (nombre, password) value ('$nombre', '$password')");
    }

    /**
     * @param string $nombre
     * @param string $password
     *
     * @return Usuario usuario
     */
    public function getUsuario($nombre, $password)
    {
        $usuario = $this
            ->conexion
            ->querySingleRow("select id, nombre from usuario where nombre = '$nombre' and password = '$password'");

        return new Usuario(
            $usuario["id"],
            $usuario["nombre"]);
    }
}