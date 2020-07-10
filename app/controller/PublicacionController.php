<?php



class PublicacionController
{
    private $renderer;
    private $publicacionDAO;
    private $tipoPublicacionDAO;
    private $seccionDAO;
    private $noticiaDAO;
    private $generoDAO;
    private $estadoDAO;

    /**
     * PublicacionController constructor.
     * @param Renderer $renderer
     * @param PublicacionDAO $publicacionDAO
     * @param TipoPublicacionDAO $tipoPublicacionDAO
     * @param SeccionDAO $seccionDAO
     * @param NoticiaDAO $noticiaDAO
     * @param EstadoDAO $estadoDAO
     * @param GeneroSeccionDAO $generoDAO
     */
    public function __construct($renderer, $publicacionDAO, $tipoPublicacionDAO, $seccionDAO, $noticiaDAO, $generoDAO, $estadoDAO)
    {
        $this->renderer = $renderer;
        $this->publicacionDAO = $publicacionDAO;
        $this->tipoPublicacionDAO = $tipoPublicacionDAO;
        $this->seccionDAO = $seccionDAO;
        $this->noticiaDAO = $noticiaDAO;
        $this->generoDAO = $generoDAO;
        $this->estadoDAO = $estadoDAO;
    }

    public function crearPublicacionVista()
    {
        $tipos_publicaciones = $this->tipoPublicacionDAO->getTiposPublicaciones();

        echo $this->renderer->render("view/crear-publicacion.mustache",
            array(
                "title" => "Crear nueva publicación",
                "data" => array(
                    "tipos_publicaciones" => TipoPublicacion::toListArrayMap($tipos_publicaciones)
                )
            )
        );
    }

    public function crearPublicacion()
    {
        try {
            $id_tipo_publicacion = $_POST["tipo_publicacion"];
            $numero = $_POST["numero"];
            $nombre = $_POST["nombre"];
            $contenido_gratuito = $_POST["contenido_gratuito"];

            $tipo_publicacion = $this->tipoPublicacionDAO->getTipoPublicacion($id_tipo_publicacion);

            return $this->publicacionDAO->insertarPublicacion($contenido_gratuito, $nombre, $numero, $tipo_publicacion->getId());
        } catch (EntityNotFoundException $ex) {
            //TODO: BadRequestException
        }
    }

    public function updateStatusPublicacion($id_publicacion)
    {
        $id_estado = $_POST["id_estado"];
        var_dump($id_estado, $id_publicacion);
        return $this->publicacionDAO->updateEstadoPublicacion($id_estado, $id_publicacion);
    }

    public function getPublicacion($id)
    {
        //echo "ver publicaion $id";
        $publicacion = $this->publicacionDAO->getPublicacion($id);
        $secciones = $this->seccionDAO->getSecciones($publicacion->getId());

        if (!is_null($secciones)) {
            foreach ($secciones as $seccion) {
                $seccion->setNoticias($this->noticiaDAO->getNoticias($seccion->getId()));
            }

            $publicacion->setSecciones($secciones);
        }
        

        // var_dump($this->generoDAO->getGeneros());
        // die;
        echo $this->renderer->render("view/mostrar-publicacion.mustache", array(
            "title" => "Publicación",
            "id" => $id,
            "publicacion" => Publicacion::toArrayMap($publicacion),
            "generos" => GeneroSeccion::toListArrayMap($this->generoDAO->getGeneros()),
            "estados" => Estado::toListArrayMap($this->estadoDAO->getEstados())
        ));
        
    }

    public function getPublicaciones()
    {
        //echo "ver publicaion $id";
        $publicaciones = $this->publicacionDAO->getPublicaciones();


        echo $this->renderer->render("view/listar-publicaciones.mustache", array(
            "title" => "Publicación",
            "publicaciones" => Publicacion::toListArrayMap($publicaciones),
            "estados" => Estado::toListArrayMap($this->estadoDAO->getEstados())
        ));
        
    }

}