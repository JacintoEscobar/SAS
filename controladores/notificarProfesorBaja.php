<?php

include '../modelos/Estudiante.php';
include '../modelos/Profesor.php';
include '../modelos/Clase.php';
include '../modelos/Notificacion.php';

// Iniciamos $_SESSION para obtener el id del alumno
session_start();

/* --------------------------- Obtenemos el nombre del estudiante que se dio de baja --------------------------- */
$alumno = new Estudiante($_SESSION['i']);
$idAlumno = md5($alumno->getID());
$datosAlumno = $alumno->getNombre();

if (!$datosAlumno) {
    echo json_encode('ERROR_GET_DATA_ALUMNO');
}

$nombreAlumno = $datosAlumno[0]; // Se obtiene el nombre del alumno

/* --------------------------- Obtenemos el id, nombre y correo del profesor --------------------------- */
$profe = new Profesor(0);
$datosProfesor = $profe->getId_Nombre_Correo(htmlentities($_POST['idc']));

if (!$datosProfesor) {
    echo json_encode('ERROR_GET_DATA_PROFESOR');
}

$idProfesor = $datosProfesor[0];
$nombreProfesor = $datosProfesor[1];
$correoProfesor = $datosProfesor[2];

/* --------------------------- Obtenemos el nombre de la clase --------------------------- */
$idClase = md5(htmlentities($_POST['idc']));
$nombreClase = htmlentities($_POST['nombreClase']);

/**
 * Creamos una notificación para enviar el correo.
 */
$notificacion = new Notificacion('Notificación de solicitud de baja.');

/**
 * Enviamos la notificación al profesor.
 */
echo json_encode($notificacion->solicitudBaja($correoProfesor, $nombreProfesor, $nombreAlumno, $nombreClase, $idClase, $idAlumno));
