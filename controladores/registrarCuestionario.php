<?php

include_once '../modelos/Cuestionario.php';
include_once '../modelos/Profesor.php';

// Obtenemos los datos enviados del formulario.
$titulo = htmlentities($_POST['titulo']);
$descripcion = htmlentities($_POST['descripcion']);
$tipo = htmlentities($_POST['tipo']);

// Iniciamos sesion para obtener el id del profesor.
session_start();
$idUsuario = $_SESSION['i'];

// Creamos un cuestionario para identificar los datos.
$cuestionario = new Cuestionario('', $titulo, $descripcion, $tipo, $idUsuario);

// Creamos un profesor para realizar la insercion.
$profesor = new Profesor($idUsuario);

// Llamamos al metodo del profesor que ejecuta la consulta de insercion.
echo json_encode(
    array('RESPUESTA' => $profesor->crearCuestionario($cuestionario))
);
