<?php

class UsuarioController
{
    private $usuarioDao;
    private $rolUsuarioDAO;
    private $renderer;

    /**
     * UsuarioController constructor.
     * @param UsuarioDAO $usuarioDao
     * @param RolUsuarioDAO $rolUsuarioDAO
     * @param Renderer $renderer
     */
    public function __construct($usuarioDao, $rolUsuarioDAO, $renderer)
    {
        $this->usuarioDao = $usuarioDao;
        $this->rolUsuarioDAO = $rolUsuarioDAO;
        $this->renderer = $renderer;
    }

    public function getUsuarios()
    {
        //echo "ver publicaion $id";
        $usuarios = $this->usuarioDao->getUsuarios();


        echo $this->renderer->render("view/listar-usuarios.mustache", array(
            "title" => "Usuarios",
            "usuarios" => Usuario::toListArrayMap($usuarios),
            "roles" => RolUsuario::toListArrayMap($this->rolUsuarioDAO->getRoles())
        ));
        
    }

    public function getUsuariosPdf()
    {
        //echo "ver publicaion $id";
        $usuarios = $this->usuarioDao->getUsuarios();


        $this->renderer->renderPdf("view/listar-usuarios-pdf.mustache", array(
            "title" => "Usuarios",
            "usuarios" => Usuario::toListArrayMap($usuarios),
            "roles" => RolUsuario::toListArrayMap($this->rolUsuarioDAO->getRoles())
        ));

    }

    public function updateRolUsuario($id_usuario)
    {
        $id_rol = $_POST["id_rol"];
        var_dump($id_rol, $id_usuario);
        return $this->usuarioDao->updateRolUsuario($id_rol, $id_usuario);
    }
}