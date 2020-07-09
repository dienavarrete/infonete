<?php

class UsuarioController
{
    private $usuarioDao;
    private $rolUsuarioDAO;
    private $renderer;

    /**
     * UsuarioController constructor.
     * @param UsuarioDAO $usuarioDao
     * @param PersonaDAO $rolUsuarioDAO
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

    
}