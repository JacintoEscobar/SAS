<?php

include '../modelos/Inscripcion.php';
include '../modelos/Estudiante.php';
include '../modelos/Clase.php';
include '../modelos/Notificacion.php';

/**
 * Obtenemos el id de la clase y del alumno del registro de inscripción.
 */
$idUsuario = htmlentities($_GET['ia']);
$idClase = htmlentities($_GET['ic']);

$inscripcion = new Inscripcion();

/**
 * Llamamos al método que ejecuta la actualización en la base de datos.
 */
$estadoActualizado = $inscripcion->setEstado($idClase, $idUsuario);

/**
 * Verificamos que la actualización se haya realizado correctamente.
 */
if ($estadoActualizado) {
    echo "<script> alert('La solicitud de baja se ha aceptado correctamente.'); </script>";

    /**
     * Obtenemos el nombre del estudiante.
     */
    $estudiante = new Estudiante($idUsuario);
    $nombreEstudiante = $estudiante->getNombre(true)[0];
    $correoEstudiante = $estudiante->getCorreo(true)[0];

    /**
     * Obtenemos el nombre de la clase.
     */
    $clase = new Clase(null, $idClase);
    $clase->getDatos(true);
    $clase = $clase->getNombre();

    /**
     * Creamos una notificación para enviar le correo al alumno.
     */
    $notificacion = new Notificacion('Notificación de baja aceptada.');

    /**
     * Enviamos la notificación
     */
    echo json_encode($notificacion->bajaAceptada($correoEstudiante, $nombreEstudiante, $clase));
} else {
    echo "<script> alert('Ocurrió un error al realizar la actualización de la información. Favor de reportar la falla.'); </script>";
}

die();
