<?php


class SuscripcionDAO
{
    /**
     * SuscripcionDAO constructor.
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->conexion = $database;
    }

    public function insertarSuscripcion($fecha_vigencia_desde, $fecha_vigencia_hasta, $id_pago, $id_usuario)
    {
        return $this
            ->conexion
            ->insertQuery("insert into suscripcion (fecha_vigencia_desde, fecha_vigencia_hasta, id_usuario) 
                            value (STR_TO_DATE('$fecha_vigencia_desde', '%Y-%m-%d'), 
                                   STR_TO_DATE('$fecha_vigencia_hasta', '%Y-%m-%d'), 
                                   $id_usuario);");
    }

}