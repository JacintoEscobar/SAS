<?php

include_once '../modelos/Cuestionario.php';
include_once '../modelos/Profesor.php';

// Obtenemos los datos del formulario.
$idC = htmlspecialchars($_POST['i'], ENT_QUOTES, 'UTF-8');
$titulo = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars($_POST['d'], ENT_QUOTES, 'UTF-8');
$tipo = htmlspecialchars($_POST['ti'], ENT_QUOTES, 'UTF-8');

// Obtenemos el id del profesor.
session_start();
$idP = $_SESSION['i'];

// Creamos un cuestinario para manejar la informacion del formulario.
$cuestionario = new Cuestionario($idC, $titulo, $descripcion, $tipo, $idP);

// Creamos un profesor para realizar la consulta.
$profesor = new Profesor($idP);

// Llamamos a la funcion que ejecuta la consulta y respondemos la peticion.
echo json_encode(array('RESPUESTA' => $profesor->editarCuestionario($cuestionario)));
