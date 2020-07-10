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

        var_dump( $_FILES );
        die;

        $ruta_indexphp = dirname(__FILE__, 2) . '/view/img';
        $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
        $extensiones = array('image/jpg','image/gif','image/png');
        $ruta_nuevo_destino = $ruta_indexphp . $_FILES['imagen']['name'];
        if ( in_array($_FILES['imagen']['type'], $extensiones) ) {
            move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ); 
        }
        return $this->noticiaDAO->insertarNoticia($titulo, $contenido, $id_seccion, $id_usuario, $ruta_nuevo_destino);
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