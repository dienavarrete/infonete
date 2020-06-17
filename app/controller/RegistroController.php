<?php

require_once "controller/GenericController.php";

class RegistroController extends GenericController
{
    private $usuario;
    private $renderer;

    public function __construct($usuario, $renderer)
    {
        $this->usuario = $usuario;
        $this->renderer = $renderer;
    }

    public function getIndex()
    {
        if ($this->existeSesion()) {
            header("Location: /dashboard");
            exit();
        }
        echo $this->renderer->render("view/registro.mustache");

    }

    public function postIndex()
    {
        if ($this->existeSesion()) {
            header("Location: /dashboard");
            exit();
        }
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