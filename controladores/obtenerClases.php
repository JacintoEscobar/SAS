<?php

include_once '../modelos/Profesor.php';

session_start();

// Almacenamos, de la sesión, el id del profesor
$id = htmlspecialchars($_SESSION['i'], ENT_QUOTES, 'UTF-8');

// Creamos un objeto profesor que permita obtener sus clases
$profesor = new Profesor($id);

// Llamamos al método que nos devuelve las clases del profesor
$clases = $profesor->getClases();

// Devolvemos el resultado de la consulta sql
echo json_encode($clases);
