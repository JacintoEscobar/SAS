<?php

include_once '../modelos/Cuestionario.php';

$idCuestionario = $_POST['idC'];
$idPregunta = $_POST['idP'];

$cuestionario = new Cuestionario($idCuestionario, '', '', '', '');

try {
    $cuestionario->deletePregunta($idPregunta);
    echo json_encode(['EXITO' => 'Pregunta eliminada de manera exitosa.']);
} catch (Exception $ex) {
    throw $ex;
}
