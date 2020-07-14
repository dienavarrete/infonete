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