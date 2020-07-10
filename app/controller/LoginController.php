<?php


class LoginController
{
    private $usuario;
    private $renderer;


    /**
     * LoginController constructor.
     * @param UsuarioDAO $usuario
     * @param Renderer $renderer
     */
    public function __construct($usuario, $renderer)
    {
        $this->usuario = $usuario;
        $this->renderer = $renderer;
    }

    public function getIndex()
    {
        echo $this->renderer->render("view/login.mustache");

    }

    public function postIndex()
    {
        $nombre_usuario = $_POST["usuario"];
        $password = md5($_POST["password"]);
        try {
            $usuario = $this->usuario->getUsuario($nombre_usuario, $password);

            $_SESSION["usuario"] = Usuario::toArrayMap($usuario);

            echo $this->renderer->render("view/login-exitoso.mustache", array(
                "usuario" => Usuario::toArrayMap($usuario)
            ));
        } catch (EntityNotFoundException $ex) {
            echo $this->renderer->render("view/login.mustache", array(
                "error" => "Datos inválidos"
            ));
        }

    }
}