<?php

/**
 * Se consultan las preguntas de un cuestionario.
 * @return array Arreglo de preguntas.
 */
function getPreguntas(string $idCuestionario)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = $conexion->prepare('SELECT * FROM pregunta WHERE idCuestionario = ?');
        $sql->bind_param('i', $idCuestionario);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $ex) {
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops</strong> ' . $ex->getMessage() . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}

$preguntas = getPreguntas($idCuestionario);
$num_preguntas = sizeof($preguntas);
