<?php


class DashboardController
{
    private $renderer;
    private $noticiaDAO;
    /**
     * DashboardController constructor.
     * @param Renderer $renderer
     * @param NoticiaDAO $noticiaDAO
     */
    public function __construct(Renderer $renderer, $noticiaDAO)
    {
        $this->renderer = $renderer;
        $this->noticiaDAO = $noticiaDAO;
    }

    public function getIndex()
    {
        if (($_SESSION["usuario"] && $_SESSION["usuario"]["suscripcion_activa"]) || $_SESSION["usuario"]["puede_generar_contenido"] ) {
            $noticias = Noticia::toListArrayMap($this->noticiaDAO->getNoticiasPagasPorUsuario());
        }else{
            $noticias = Noticia::toListArrayMap($this->noticiaDAO->getNoticiasGratuitasPorUsuario());
        }
        echo $this->renderer->render("view/inicio.mustache",
            array(
                "title" => "Página inicio",
                "noticias" => $noticias
            ));
    }
}