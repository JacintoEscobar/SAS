<?php

include_once '../modelos/Topico.php';

// Obtenemos el id de la ua que se quiere eliminar.
$idUA = htmlentities($_POST['i']);
$titulo = htmlentities($_POST['t']);
$descripcion = htmlentities($_POST['d']);

// Creamos una ua con el id enviado.
$topico = new Topico(null, $titulo, $descripcion, $idUA);

// Llamamos a la función que eliminar la ua.
echo json_encode(array('RESULTADO' => $topico->eliminar()));
