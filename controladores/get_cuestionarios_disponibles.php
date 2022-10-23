<?php

/**
 * Consulta los cuestionarios asignados a un clase por medio del id de la clase
 * para mostrarlos al alumno y que pueda responderlos.
 */
function get_cuestionarios_disponibles($idClase)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT * FROM cuestionario INNER JOIN asignacion ON asignacion.idCuestionario = cuestionario.idCuestionario WHERE asignacion.idClase = ?');
        $consulta->bind_param('i', $idClase);
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $ex) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops</strong> ' . $ex->getMessage() . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$cuestionarios = get_cuestionarios_disponibles(htmlspecialchars($_GET['idC'], ENT_QUOTES, 'UTF-8'));
