<?php

/**
 * Consulta las evaluaciones de un alumno.
 * @param string $idU
 * @return mixed arreglo con los registros de las evaluaciones.
 */
function getEvaluaciones(string $idU)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT evaluacion.idEvaluacion as id, titulo as cuestionario, puntaje, etiqueta.nombre as etiqueta FROM cuestionario
                                        INNER JOIN evaluacion ON evaluacion.idCuestionario = cuestionario.idCuestionario
                                        INNER JOIN usuario ON evaluacion.idUsuario = usuario.idUsuario
                                        INNER JOIN etiqueta ON evaluacion.idEtiqueta = etiqueta.idEtiqueta
                                        WHERE evaluacion.idUsuario = ? ORDER BY evaluacion.idEvaluacion DESC');
        $consulta->bind_param('i', $idU);
        $consulta->execute();
        $registros = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        $conexion->close();
        return $registros;
    } catch (\Throwable $th) {
        echo
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> Ocurrió un errro al obtener tus evaluaciones.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$evaluaciones = getEvaluaciones($_SESSION['i']);
