<?php

include_once '../modelos/Asignacion.php';

session_start();

$fechaAsignacion = date('Y-m-d');
$fechaCierre = htmlspecialchars($_POST['fechaCierra'], ENT_QUOTES, 'UTF-8');
$idCuestionario = htmlspecialchars($_POST['idCuestionario'], ENT_QUOTES, 'UTF-8');
$idClase = $_SESSION['idC'];

$asignacion = new Asignacion('', $fechaAsignacion, $fechaCierre, $idCuestionario, $idClase);

/* echo json_encode(['EXITO' => date('Y-m-d')]); */

try {
    if ($asignacion->insertar()) {
        echo json_encode(['EXITO' => 'Cuestionario asignado exitosamente.']);
    } else {
        throw new Exception('Ocurrió un error al asignar el cuestionario.');
    }
} catch (Exception $ex) {
    throw $ex;
}
