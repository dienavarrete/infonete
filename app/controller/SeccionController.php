<?php


class SeccionController
{
    private $renderer;
    private $seccionDAO;

    /**
     * SeccionController constructor.
     * @param Renderer $renderer
     * @param SeccionDAO $seccionDAO
     */
    public function __construct($renderer, $seccionDAO)
    {
        $this->renderer = $renderer;
        $this->seccionDAO = $seccionDAO;
    }

    public function crearSeccion($id_publicacion)
    {

        $id_genero = $_POST["id_genero"];
        // var_dump($id_genero);
        // die();
        return $this->seccionDAO->insertarSeccion($id_genero, $id_publicacion);
    }

}