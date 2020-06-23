<?php

require_once("helper/Renderer.php");
include_once("helper/Database.php");
include_once("helper/Config.php");
require_once('third-party/mustache/src/Mustache/Autoloader.php');


class ModuleInitializer
{
    private $renderer;
    private $config;
    private $database;

    public function __construct()
    {
        $this->renderer = new Renderer('view/partial');
        $this->config = new Config("config/config.ini");
        $this->database = Database::getInstance($this->config);
    }

    /**
     * @return InicioController
     */
    public function createInicioController()
    {
        include_once("controller/InicioController.php");
        return new InicioController($this->renderer);
    }

    /**
     * @return RegistroController
     */
    public function createRegistroController()
    {
        include_once("controller/RegistroController.php");
        include_once("dao/UsuarioDAO.php");
        include_once("dao/PersonaDAO.php");

        $usuarioDao = new UsuarioDAO($this->database);
        $personaDao = new PersonaDAO($this->database);
        return new RegistroController($usuarioDao, $personaDao, $this->renderer);
    }

    /**
     * @return LoginController
     */
    public function createLoginController()
    {
        include_once("controller/LoginController.php");
        include_once("dao/UsuarioDAO.php");

        $usuarioDao = new UsuarioDAO($this->database);
        return new LoginController($usuarioDao, $this->renderer);
    }

    /**
     * @return DashboardController
     */
    public function createDashboardController()
    {
        include_once("controller/DashboardController.php");
        include_once("dao/UsuarioDAO.php");

        return new DashboardController($this->renderer);
    }

    /**
     * @return LogoutController
     */
    public function createLogoutController()
    {
        include_once("controller/LogoutController.php");

        return new LogoutController();
    }

    /**
     * @return HttpErrorController
     */
    public function createError404Controller()
    {
        include_once("controller/HttpErrorController.php");

        return new HttpErrorController($this->renderer);
    }

    /**
     * @return NoticiaController
     */
    public function createNoticiaController()
    {
        include_once("controller/NoticiaController.php");
        include_once("dao/NoticiaDAO.php");

        $noticiaDao = new NoticiaDAO($this->database);

        return new NoticiaController($this->renderer, $noticiaDao);
    }

    /**
     * @return PublicacionController
     */
    public function createPublicacionController()
    {
        include_once("controller/PublicacionController.php");
        include_once("dao/PublicacionDAO.php");
        include_once("dao/TipoPublicacionDAO.php");
        include_once("dao/SeccionDAO.php");
        include_once("dao/NoticiaDAO.php");

        $publicacionDao = new PublicacionDAO($this->database);
        $tipoPublicacionDao = new TipoPublicacionDAO($this->database);
        $seccionDao = new SeccionDAO($this->database);
        $noticiaDao = new NoticiaDAO($this->database);

        return new PublicacionController($this->renderer, $publicacionDao, $tipoPublicacionDao, $seccionDao, $noticiaDao);
    }

}