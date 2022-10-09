<?php

include_once '../modelos/Profesor.php';

// Iniciamos sesion para obtener el id del profesor.
session_start();

// Creamos un profesor para realizar la consulta de los cuestionarios.
$profesor = new Profesor($_SESSION['i']);
echo json_encode(
    array('RESULTADO' => $profesor->getCuestionarios())
);
