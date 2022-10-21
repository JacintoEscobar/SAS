<?php

include_once '../modelos/Clase.php';
include_once '../modelos/Asignacion.php';
include_once '../modelos/NotificacionBD.php';
include_once '../modelos/Notificacion.php';

// Obtenemos el id de la clase para obtener la información de los alumnos.
session_start();
$idClase = $_SESSION['idC'];

// Creamos un objeto clase para obtener a todos
// los alumnos inscritos en dicha clase.
$clase = new Clase(null, $idClase);
$alumnos = [];

try {
    $alumnos = $clase->getAlumnosInscritos();
} catch (Exception $ex) {
    throw $ex;
}

// Obtenemos el id del cuestionario para obtener el id de la asignación y relacionarlos en la notificación.
// Obtenemos el título del cuestionario para mostrarlo en el mensaje de notificación.
$idCuestionario = htmlspecialchars($_POST['idCuestionario'], ENT_QUOTES, 'UTF-8');
$tituloCuestionario = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'UTF-8');

// Creamos un objeto asignación para obtener el id cuyo idCuestionario coincida con el asignado.
$asignacion = new Asignacion('', '', '', '', '');
$idAsignacion = $asignacion->getAsignacion('idCuestionario', $idCuestionario)['idAsignacion'];

// Recorremos a todos los alumnos para notificarles de la asignación.
$num_alumnos = sizeof($alumnos);
$mensaje = '';
for ($i = 0; $i < $num_alumnos; $i++) {
    // Insertamos un registro de notificación.
    $mensaje = 'Tienes un nuevo cuestionario. Response ' . $tituloCuestionario . ' cuanto antes.';
    $notificacionBD = new NotificacionBD(null, $mensaje, $idAsignacion, $alumnos[$i]['idAlumno']);

    try {
        $notificacionBD->insertar();
    } catch (Exception $ex) {
        throw $ex;
    }

    // Enviamos por correo elcetrónico al alumno.
    $notificacionEmail = new Notificacion('Nuevo cuestionario activo.');
    try {
        $notificacionEmail->nuevoCuestionario($alumnos[$i]['correo'], $alumnos[$i]['alumno'], $alumnos[$i]['paterno'], $tituloCuestionario);
    } catch (Exception $ex) {
        continue;
    }
}

echo json_encode(
    ['clase' => [
        'idClase' => $_SESSION['idC'],
        'tituloClase' => $_SESSION['titC']
    ]]
);
