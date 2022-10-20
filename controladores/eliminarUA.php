<?php

include_once '../modelos/UnidadAprendizaje.php';

// Obtenemos el id de la ua que se quiere eliminar.
$idUA = htmlspecialchars($_POST['i'], ENT_QUOTES, 'UTF-8');

// Creamos una ua con el id enviado.
$ua = new UnidadAprendizaje($idUA);

// Llamamos a la función que eliminar la ua.
echo json_encode(array('RESULTADO' => $ua->eliminar()));
