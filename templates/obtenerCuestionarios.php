<?php

include_once '../modelos/Profesor.php';
include_once '../modelos/Cuestionario.php';

$profesor = new Profesor($_SESSION['i']);

$cuestionarios = null;
$cuestionarios_no_asignados = [];
try {
    $cuestionarios = $profesor->obtenerCuestionarios();

    $num_cuestionarios = sizeof($cuestionarios);
    for ($i = 0; $i < $num_cuestionarios; $i++) {
        $cuestionario_actual = new Cuestionario($cuestionarios[$i]['idCuestionario'], '', '', '', '');
        if (!$cuestionario_actual->isAsignado()) {
            array_push($cuestionarios_no_asignados, $cuestionarios[$i]);
        }
    }
} catch (Exception $ex) {
    echo
    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> ' . $ex->getMessage() . '.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
