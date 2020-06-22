<?php


class NoticiaController
{
    private $renderer;
    private $noticiaDAO;

    /**
     * NoticiaController constructor.
     * @param Renderer $renderer
     * @param NoticiaDAO $noticiaDAO
     */
    public function __construct($renderer, $noticiaDAO)
    {
        $this->renderer = $renderer;
        $this->noticiaDAO = $noticiaDAO;
    }

    public function crearNoticia($id_seccion)
    {
        var_dump($_POST);
    }

    public function formularioNoticia($id_seccion)
    {

        echo $this->renderer->render("view/crear-noticia.mustache", array(
            "title" => "Crear nueva noticia",
            "data" => array(
                "id_seccion" => $id_seccion
            )
        ));
    }
}