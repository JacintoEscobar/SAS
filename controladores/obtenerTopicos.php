<?php

include '../modelos/UnidadAprendizaje.php';

// Obtenemos el id de la ua.
$idUA = htmlentities($_GET['iau']);

// Creamos una ua para acceder a sus tópicos.
$ua = new UnidadAprendizaje($idUA);

// Obtenemos los tópicos.
$topicos = $ua->getTopicos();

// Verificamos que no haya ocurrido ningún error con la consulta.
if (gettype($topicos) == 'string') {
    echo json_encode(array('ERROR' => $topicos));
}

echo json_encode(array('topicos' => $topicos));