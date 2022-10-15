<?php

include_once '../modelos/Cuestionario.php';
include_once '../modelos/Pregunta.php';

$idCuestionario = $_GET['i'];

$cuestionario = new Cuestionario($idCuestionario, '', '', '', '');

try {
    $preguntas = $cuestionario->getPreguntas();

    $num_preguntas = sizeof($preguntas);
    for ($i = 0; $i < $num_preguntas; $i++) {
        $pregunta_actual = new Pregunta(
            $preguntas[$i]['idPregunta'],
            $preguntas[$i]['pregunta'],
            $preguntas[$i]['idCuestionario']
        );

        $respuestas = $pregunta_actual->getRespuestas();

        $preguntas[$i]['respuestas'] = $respuestas;
    }

    echo json_encode(['PREGUNTAS' => $preguntas]);
} catch (Exception $ex) {
    throw $ex;
}
