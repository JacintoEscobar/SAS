<?php

use function PHPSTORM_META\type;

include '../modelos/Clase.php';

session_start();

// Obtenemos el id de la clase.
$idC = htmlspecialchars($_SESSION['idC'], ENT_QUOTES, 'UTF-8');

// Creamos una clase para poder acceder a sus unidades de aprendizaje.
$clase = new Clase(null, $idC);

// Obtenemos las unidades de aprendizaje.
$ua = $clase->getUA();

// Verificamos que no haya ocurrido ningún error con la consulta.
if (gettype($ua) == 'string') {
    echo json_encode(array('ERROR' => $ua));
}

echo json_encode(array('U\'sA' => $ua));
