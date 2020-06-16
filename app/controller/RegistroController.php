<?php


class RegistroController
{
    private $usuario;
    private $renderer;

    public function __construct($usuario, $renderer)
    {
        $this->usuario = $usuario;
        $this->renderer = $renderer;
    }

    public function index()
    {
        echo $this->renderer->render("view/registro.mustache");
    }

    public function postUsuario()
    {
        $nombre = $_POST["nombre"];
        $password = md5($_POST["password"]);

        $result = $this->usuario->insertarUsuario($nombre, $password);

        if ($result) {
            echo $this->renderer->render("view/registro-exito.mustache");
        } else {
            echo $this->renderer->render("view/registro-fallido.mustache");
        }
    }
}