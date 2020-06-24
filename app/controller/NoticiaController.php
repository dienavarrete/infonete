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

        $titulo = $_POST["titulo"];
        $contenido = $_POST["contenido"];
        $id_usuario = $_SESSION["usuario"]["id"];

        return $this->noticiaDAO->insertarNoticia($titulo, $contenido, $id_seccion, $id_usuario);
    }

    public function formularioNoticia($id_seccion)
    {
        echo $id_seccion;
        /*echo $this->renderer->render("view/crear-noticia.mustache", array(
            "title" => "Crear nueva noticia",
            "data" => array(
                "id_seccion" => $id_seccion
            )
        ));*/
    }
}