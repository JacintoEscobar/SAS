<?php

include_once '../modelos/Cuestionario.php';

// Obtenemos el cuestionario y sus preguntas.
$cuest_array = json_decode($_POST['cuestionario'], true);
$preguntas = json_decode($_POST['preguntas'], true);

// Creamos un cuestionario para llamar al metodo que asigna sus preguntas.
$cuestionario = new Cuestionario(
    $cuest_array['idCuestionario'],
    $cuest_array['titulo'],
    $cuest_array['descripcion'],
    $cuest_array['tipo'],
    $cuest_array['idUsuario'],
);

$resultado = $cuestionario->guardarCambios($preguntas, $cuestionario->getID());

if (gettype($resultado) == 'string')
    echo json_encode(['ERROR' => $resultado]);
else
    echo json_encode(['EXITO' => 'Datos guardados de manera satisfactoria.']);
