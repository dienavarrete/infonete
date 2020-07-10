<?php


class InicioController
{
    private $renderer;
    private $noticiaDAO;

    /**
     * InicioController constructor.
     * @param Renderer $renderer
     */
    public function __construct($renderer, $noticiaDAO)
    {
        $this->renderer = $renderer;
        $this->noticiaDAO = $noticiaDAO;
    }

    public function getIndex()
    {
        echo $this->renderer->render("view/inicio.mustache",
            array(
                "title" => "Página inicio",
                "noticias" => Noticia::toListArrayMap($this->noticiaDAO->getNoticiasPorUsuario())
            ));
    }
}