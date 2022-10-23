<?php

/**
 * Se consultan las preguntas de un cuestionario.
 * @return array Arreglo de preguntas.
 */
function getRespuestas(string $idPregunta)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = $conexion->prepare('SELECT * FROM respuestaMultiple WHERE idPregunta = ?');
        $sql->bind_param('i', $idPregunta);
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

$respuestas = [];
for ($i = 0; $i < $num_preguntas; $i++) {
    array_push($respuestas, getRespuestas($preguntas[$i]['idPregunta']));
}

$num_respuestas = sizeof($respuestas);
