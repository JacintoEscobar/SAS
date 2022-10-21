<?php

include_once '../modelos/BD.php';

class NotificacionBD extends BD
{
    private $idNotificacion;
    private $mensaje;
    private $idAsignacion;
    private $idAlumno;

    public function __construct($idNotificacion = null, $mensaje, $idAsignacion, $idAlumno)
    {
        $this->idNotificacion = $idNotificacion;
        $this->mensaje = $mensaje;
        $this->idAsignacion = $idAsignacion;
        $this->idAlumno = $idAlumno;
    }

    /**
     * Realiza la consulta de inserción de una nueva notificación.
     */
    public function insertar()
    {
        try {
            $this->conectar();
            $consulta = $this->conexion->prepare('INSERT INTO notificacion(mensaje, idAsignacion, idUsuario) VALUES(?, ?, ?)');
            $consulta->bind_param('sii', $this->mensaje, $this->idAsignacion, $this->idAlumno);
            $consulta->execute();
            return;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
