<?php


class UserLoggedException extends RuntimeException
{
    private $mensaje;

    /**
     * UserLoggedException constructor.
     * @param $mensaje
     */
    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }


    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }
}