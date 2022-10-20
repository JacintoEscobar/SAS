<?php

include_once '../modelos/Cuestionario.php';
include_once '../modelos/Profesor.php';

// Obtenemos el id del cuestionario enviado por POST.
$idC = htmlspecialchars($_POST['i'], ENT_QUOTES, 'UTF-8');

// Obtenemos el id del profesor
session_start();
$idP = $_SESSION['i'];

// Creamos un cuestionario para identificar la informacion del mismo.
$cuestionario = new Cuestionario($idC, '', '', '', $idP);

// Creamos un profesor para realizar la consulta.
$profesor = new Profesor($idP);

// Llamamos al metodo que realiza la consulta y devolvemos la respuesta de esta.
echo json_encode(array('RESPUESTA' => $profesor->eliminarCuestionario($cuestionario)));
