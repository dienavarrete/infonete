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

    public function index()
    {
        echo $this->renderer->render("view/login.mustache");
    }

    public function postUsuario()
    {
        $nombre = $_POST["nombre"];
        $password = md5($_POST["password"]);
        try {
            $usuario = $this->usuario->getUsuario($nombre, $password);

            $_SESSION["usuario"] = serialize($usuario);

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