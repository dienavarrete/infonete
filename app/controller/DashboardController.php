<?php

class DashboardController
{
    private $renderer;

    /**
     * DashboardController constructor.
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function index()
    {
        $usuario = unserialize($_SESSION["usuario"]);
        echo $this->renderer->render("view/dashboard.mustache",
            array("usuario" => Usuario::toArrayMap($usuario)));
    }
}