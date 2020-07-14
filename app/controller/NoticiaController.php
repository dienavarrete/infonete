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
        $contenido = nl2br($_POST["contenido"]);
        $id_usuario = $_SESSION["usuario"]["id"];

        $extensiones = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');

        if (in_array($_FILES['imagen']['type'], $extensiones)) {
            $ruta_indexphp = '/view/img/';
            $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];

            $nuevo_nombre = md5(date(DATE_ATOM)) . "." . explode(".", $_FILES['imagen']['name'])[1];
            $ruta_nuevo_destino = dirname(__FILE__, 2) . $ruta_indexphp . $nuevo_nombre;

            move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino);

            return $this->noticiaDAO->insertarNoticia($titulo, $contenido, $id_seccion, $id_usuario, $ruta_indexphp . $nuevo_nombre);
        } else {
            return $this->noticiaDAO->insertarNoticia($titulo, $contenido, $id_seccion, $id_usuario, null);
        }


    }

    public function getNoticia($id)
    {
        $noticia = Noticia::toArrayMap($this->noticiaDAO->getNoticia($id));

        // echo $noticia["contenido_gratuito"];
        // if ($noticia["contenido_gratuito"] == 0 && !$_SESSION["usuario"]["suscripcion_activa"]) {
        //     //header("Location: /login");
        //     //exit();
        // }

        echo $this->renderer->render("view/mostrar-noticia.mustache", array(
            "title" => "Noticia",
            "id" => $id,
            "noticia" => $noticia,
        ));

    }
}