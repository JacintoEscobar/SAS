<?php

function consultaResultados($idCuestionario)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT titulo, etiqueta.nombre as etiqueta, COUNT(*) as total, count(*) * 100.0 / sum(count(*)) over() as porcentaje FROM evaluacion INNER JOIN etiqueta on etiqueta.idEtiqueta=evaluacion.idEtiqueta INNER JOIN cuestionario ON evaluacion.idCuestionario=cuestionario.idCuestionario WHERE evaluacion.idCuestionario= ? GROUP BY etiqueta.nombre');
        $consulta->bind_param('i', $idCuestionario);
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

$resultados = consultaResultados(htmlspecialchars($idCuestionario, ENT_QUOTES, 'UTF-8'));

?>