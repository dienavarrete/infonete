<?php


class HttpErrorController
{
    private $renderer;

    /**
     * HttpErrorController constructor.
     * @param Renderer $renderer
     */
    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function get404()
    {
        echo $this->renderer->render("view/errors/404.mustache",
            array("title" => "Página no encontrada"));
    }
}