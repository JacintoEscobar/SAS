<?php

include_once '../modelos/Cuestionario.php';
include_once '../modelos/Pregunta.php';

$cuestionarioObj = json_decode($_POST['cuestionario']);
$preguntasNuevasArray = json_decode($_POST['preguntasNuevas']);

$cuestionario = new Cuestionario(
    $cuestionarioObj->idCuestionario,
    $cuestionarioObj->titulo,
    $cuestionarioObj->descripcion,
    $cuestionarioObj->tipo,
    $cuestionarioObj->idUsuario
);

$num_preguntas = sizeof($preguntasNuevasArray);
for ($i = 0; $i < $num_preguntas; $i++) {
    $cuestionario->addPregunta($preguntasNuevasArray[$i]->pregunta);
    $pregunta = new Pregunta('', $preguntasNuevasArray[$i]->pregunta, $cuestionarioObj->idCuestionario);
    $idP = $pregunta->getIDPorConsulta();

    $num_respuestas = sizeof($preguntasNuevasArray[$i]->respuestas);
    for ($j = 0; $j < $num_respuestas; $j++) {
        $cuestionario->addRespuesta($preguntasNuevasArray[$i]->respuestas[$j], $idP);
    }
}

echo json_encode(['EXITO' => 'Se registraron las preguntas de manera correcta.']);