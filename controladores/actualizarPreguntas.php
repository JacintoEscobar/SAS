<?php

include_once '../modelos/Cuestionario.php';
include_once '../modelos/Pregunta.php';

$cuestionarioObj = json_decode($_POST['cuestionario']);
$preguntasEditadasArray = json_decode($_POST['preguntasEditadas']);

$cuestionario = new Cuestionario(
    $cuestionarioObj->idCuestionario,
    $cuestionarioObj->titulo,
    $cuestionarioObj->descripcion,
    $cuestionarioObj->tipo,
    $cuestionarioObj->idUsuario
);

$num_preguntas = sizeof($preguntasEditadasArray);
for ($i = 0; $i < $num_preguntas; $i++) {
    $cuestionario->actualizarPregunta($preguntasEditadasArray[$i]);

    $num_respuestas = sizeof($preguntasEditadasArray[$i]->respuestas);
    for ($j = 0; $j < $num_respuestas; $j++) {
        $cuestionario->actualizarRespuesta($preguntasEditadasArray[$i]->respuestas[$j]);
    }
}

echo json_encode(['EXITO' => 'Se actualizarion las preguntas de manera correcta.']);
