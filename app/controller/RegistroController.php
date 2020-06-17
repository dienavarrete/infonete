<?php

require_once "controller/GenericController.php";

class RegistroController extends GenericController
{
    private $usuarioDao;
    private $personaDao;
    private $renderer;

    /**
     * RegistroController constructor.
     * @param UsuarioDAO $usuarioDao
     * @param PersonaDAO $personaDao
     * @param Renderer $renderer
     */
    public function __construct($usuarioDao, $personaDao, $renderer)
    {
        $this->usuarioDao = $usuarioDao;
        $this->personaDao = $personaDao;
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

        $usuario = $_POST["usuario"];
        $password = md5($_POST["password"]);
        $password2 = md5($_POST["password2"]);
        $nombres = $_POST["nombres"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = date($_POST["fecha_nacimiento"]);


        if ($password !== $password2) {
            echo $this->renderer->render("view/registro.mustache", array(
                "error" => "Las contraseñas no coinciden",
                "data" => array(
                    "usuario" => $usuario,
                    "nombres" => $nombres,
                    "apellido" => $apellido,
                    "fecha_nacimiento" => $fecha_nacimiento
                )
            ));
            exit();
        }

        $id_persona = $this
            ->personaDao
            ->insertarPersona($apellido, $nombres, $fecha_nacimiento);

        try {
            $id_usuario = $this
                ->usuarioDao
                ->insertarUsuario($usuario, $password, $id_persona);
        } catch (InsertEntityException $ex) {
            $this
                ->personaDao
                ->borrarPersona($id_persona);

            echo $this->renderer->render("view/registro.mustache", array(
                "error" => "Error al generar usuario",
                "data" => array(
                    "usuario" => $usuario,
                    "nombres" => $nombres,
                    "apellido" => $apellido,
                    "fecha_nacimiento" => $fecha_nacimiento
                )
            ));
            exit();
        }


        if ($usuario) {
            echo $this->renderer->render("view/registro-exito.mustache");
        } else {
            echo $this->renderer->render("view/registro.mustache", array(
                "error" => "Error al realizar registro",
                "data" => array(
                    "usuario" => $usuario,
                    "nombres" => $nombres,
                    "apellido" => $apellido,
                    "fecha_nacimiento" => $fecha_nacimiento
                )
            ));
            exit();
        }

    }
}