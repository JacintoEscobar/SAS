<?php

include_once '../modelos/RegistroEtiqueta.php';

// Obtenemos el id del alumno y de la etiqueta.
$idA = htmlspecialchars($_POST['idA'], ENT_QUOTES, 'UTF-8');
$idE = htmlspecialchars($_POST['idE'], ENT_QUOTES, 'UTF-8');

$registroEtiqueta = new RegistroEtiqueta('', $idE, $idA);

echo json_encode($registroEtiqueta->insertar());
