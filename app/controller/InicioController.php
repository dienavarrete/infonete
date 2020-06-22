<?php


class InicioController
{
    private $renderer;

    /**
     * InicioController constructor.
     * @param Renderer $renderer
     */
    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function getIndex()
    {
        echo $this->renderer->render("view/inicio.mustache",
            array("title" => "Página inicio"));
    }
}