<?php


class DashboardController
{
    private $renderer;
    private $noticiaDAO;
    /**
     * DashboardController constructor.
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer, $noticiaDAO)
    {
        $this->renderer = $renderer;
        $this->noticiaDAO = $noticiaDAO;
    }

    public function getIndex()
    {
        echo $this->renderer->render("view/dashboard.mustache",
            array(
                "title" => "Dashboard",
                "noticias" => $this->noticiaDAO->getNoticiasPorUsuario()
        ));
    }
}