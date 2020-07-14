<?php

require_once ("excepciones/SuscripcionActivaException.php");

class SuscripcionController
{
    private $renderer;
    private $suscripcionDao;

    /**
     * SuscripcionController constructor.
     * @param Renderer $renderer
     * @param SuscripcionDAO $suscripcionDao
     */
    public function __construct($renderer, $suscripcionDao)
    {
        $this->renderer = $renderer;
        $this->suscripcionDao = $suscripcionDao;
    }

    public function createSuscripcion()
    {
        if (!$_SESSION['usuario']['suscripcion_activa']) {

            $id_usuario = $_SESSION['usuario']['id'];
            $fecha_vigencia_desde = date('Y-m-d');
            $fecha_vigencia_hasta = date('Y-m-d', strtotime($fecha_vigencia_desde . ' + 30 days'));;

            $this->suscripcionDao->insertarSuscripcion($fecha_vigencia_desde, $fecha_vigencia_hasta, null, $id_usuario);
        } else {
            throw new SuscripcionActivaException("Usuario ya tiene suscripción activa");
        }

    }

    public function getSuscripcionesView()
    {
        echo $this->renderer->render("view/suscripcion.mustache", array(
            "title" => "Suscripciones"
        ));
    }
}