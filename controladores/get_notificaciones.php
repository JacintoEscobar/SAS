<?php

include_once '../modelos/Estudiante.php';

$id = $_SESSION['i'];

$estudiante = new Estudiante($id);

$notificaciones = [];
try {
    $notificaciones = $estudiante->getNotificaciones();
} catch (Exception $ex) {
    echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops</strong> ' . $ex->getMessage() . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

/**
 * Consulta los cuestionarios asignados a un clase por medio del id
 * de la asignación para mostrarlos al alumno y que pueda responderlos.
 */
function getCuestionariosAsignado($idA)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT * FROM cuestionario INNER JOIN asignacion ON asignacion.idCuestionario = cuestionario.idCuestionario WHERE asignacion.idAsignacion = ?');
        $consulta->bind_param('i', $idA);
        $consulta->execute();
        return $consulta->get_result()->fetch_assoc();
    } catch (Exception $ex) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops</strong> ' . $ex->getMessage() . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$num_notificaciones = sizeof($notificaciones);
$cuestionarios = [];

for ($i = 0; $i < $num_notificaciones; $i++) {
    $cuestionario = getCuestionariosAsignado($notificaciones[$i]['idAsignacion']);
    array_push($cuestionarios, $cuestionario);
}
