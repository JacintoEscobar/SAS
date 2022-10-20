<?php

include_once '../modelos/Topico.php';

// Obtenemos el id de la ua que se quiere eliminar.
$idUA = htmlspecialchars($_POST['i'], ENT_QUOTES, 'UTF-8');
$titulo = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars($_POST['d'], ENT_QUOTES, 'UTF-8');

// Creamos una ua con el id enviado.
$topico = new Topico(null, $titulo, $descripcion, $idUA);

// Llamamos a la función que eliminar la ua.
echo json_encode(array('RESULTADO' => $topico->eliminar()));
