<?php

include_once '../modelos/UnidadAprendizaje.php';
include_once '../modelos/Topico.php';

// Obtenemos los datos del formulario.
$idUA = htmlentities($_POST['idUA']);
$tituloT = htmlentities($_POST['titulo']);
$descripcionT = htmlentities($_POST['descripcion']);

// Creamos una unidad de aprendizaje.
$ua = new UnidadAprendizaje($idUA);

/**
 * Llamamos al método que ejecuta la consulta sql para insertar un tópico en la bd.
 * Verificamos que la consulta se haya realizado exitosamente.
 */
$errorInsercion = $ua->insertarTopico(new Topico(null, $tituloT, $descripcionT, $idUA));
if ($errorInsercion == 1) {
    echo json_encode('EXITO');
} else {
    echo json_encode($errorInsercion);
}
