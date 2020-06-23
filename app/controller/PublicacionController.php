<?php


class PublicacionController
{
    private $renderer;
    private $publicacionDAO;
    private $tipoPublicacionDAO;
    private $seccionDAO;
    private $noticiaDAO;

    /**
     * PublicacionController constructor.
     * @param Renderer $renderer
     * @param PublicacionDAO $publicacionDAO
     * @param TipoPublicacionDAO $tipoPublicacionDAO
     * @param SeccionDAO $seccionDAO
     * @param NoticiaDAO $noticiaDAO
     */
    public function __construct($renderer, $publicacionDAO, $tipoPublicacionDAO, $seccionDAO, $noticiaDAO)
    {
        $this->renderer = $renderer;
        $this->publicacionDAO = $publicacionDAO;
        $this->tipoPublicacionDAO = $tipoPublicacionDAO;
        $this->seccionDAO = $seccionDAO;
        $this->noticiaDAO = $noticiaDAO;
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
            $contenido_gratuito = $_POST["contenido_gratuito"];

            $tipo_publicacion = $this->tipoPublicacionDAO->getTipoPublicacion($id_tipo_publicacion);

            return $this->publicacionDAO->insertarPublicacion($contenido_gratuito, $numero, $tipo_publicacion->getId());
        } catch (EntityNotFoundException $ex) {
            //TODO: BadRequestException
        }
    }

    public function getPublicacion($id)
    {
        //echo "ver publicaion $id";
        $publicacion = $this->publicacionDAO->getPublicacion($id);
        $secciones = $this->seccionDAO->getSecciones($publicacion->getId());

        foreach ($secciones as $seccion) {
            $seccion->setNoticias($this->noticiaDAO->getNoticias($seccion->getId()));
        }

        $publicacion->setSecciones($secciones);

        echo $this->renderer->render("view/mostrar-publicacion.mustache", array(
            "title" => "Publicación",
            "publicacion" => Publicacion::toArrayMap($publicacion)
        ));
        /*echo $this->renderer->render("view/mostrar-publicacion.mustache", array(
            "title" => "Publicación",
            "publicacion" => [
                "id" => $id,
                "secciones" => [
                    [
                        "id" => 1,
                        "nombre" => "Tecnología",
                        "noticias" => [
                            [
                                "id" => 1,
                                "titulo" => "macOS Big Sur: las principales novedades que llegan a este sistema operativo",
                                "contenido" => "Apple presentó hoy una vista previa de macOS Big Sur, la última versión de su sistema operativo de escritorio. El macOS Big Sur o presenta un nuevo rediseño que facilita la interacción con múltiples ventanas."
                            ],
                            [
                                "id" => 1,
                                "titulo" => "El ex CEO de Google dijo que “no hay dudas” de que Huawei envía datos al régimen chino",
                                "contenido" => "El ex director ejecutivo de Google, Eric Schmidt, señaló que “no hay dudas” sobre las prácticas “no aceptables” de Huawei respecto al manejo de los datos de los usuarios que hace la empresa tecnológica china que responde al régimen de Beijing. “No hay duda de que Huawei se ha involucrado en algunas prácticas que no son aceptables en seguridad nacional”, dijo el ex CEO de la compañía norteamericana."
                            ],

                        ]
                    ],
                    [
                        "id" => 2,
                        "nombre" => "Deportes",
                        "noticias" => [
                            [
                                "id" => 1,
                                "titulo" => "Alerta en Manchester City: la patada que sacó al Kun Agüero del partido ante Burnley y el pronóstico pesimista de Guardiola",
                                "contenido" => "Corrían 44 minutos del segundo tiempo en la victoria del Manchester City ante el Burnley, por la fecha 30 de la Premier League. Phil Foden desbordó por la banda izquierda, envió al centro del área y, cuando Sergio Agüero se aprestaba a definir, se lo impidió el planchazo de Benjamin Mee, que impactó sobre el empeine de su pie derecho. El árbitro, VAR mediante, sancionó el penal, que Mahrez transformó en el 3-0. Pero el Kun, de 32 años, se quedó sin partido, haciendo encender todas las alarmas en el banco de suplentes de los Ciudadanos."
                            ],
                            [
                                "id" => 1,
                                "titulo" => "El sensacional gol de Paulo Dybala tras recibir un taco de espaldas en el triunfo de Juventus ante Bologna",
                                "contenido" => "El líder Juventus venció al Bologna por 2 a 0 en la continuidad del fútbol italiano. El líder, que se mantiene en la cima de las posiciones de la Serie A en el inicio de la jornada 27, triunfó por los tantos de Cristiano Ronaldo de penal, a los 23 minutos, y Paulo Dybala a los 36′. En el equipo local, Rodrigo Palacio y Nicolás Domínguez ingresaron en el segundo tiempo."
                            ],

                        ]
                    ],
                ]
            ]
        ));*/
    }

}