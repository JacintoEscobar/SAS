<?php

include_once '../modelos/UnidadAprendizaje.php';
include_once '../modelos/Clase.php';

// Obtenemos los datos del formulario.
$titulo = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars($_POST['d'], ENT_QUOTES, 'UTF-8');

// Creamos una ua para identificar sus campos.
$ua = new UnidadAprendizaje(null);
$ua->setTitulo($titulo);
$ua->setDescripcion($descripcion);

// Obtenemos el id de la clase
session_start();
$idC = htmlentities($_SESSION['idC']);

// Creamos una clase para pasarle la ua que se insertará.
$clase = new Clase(null, $idC);

// Llamamos al método que realiza la inserción de la ua en la clase.
if ($clase->addUA($ua) == 1) {
    echo json_encode('La unidad de aprendizaje se registró correctamente.');
} else {
    echo json_encode('No se pudo registrar la unidad de aprendizaje.');
}
