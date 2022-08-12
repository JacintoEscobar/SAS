<?php

include '../modelos/Clase.php';

session_start();

$clase = new Clase(htmlentities($_POST['c']));

echo json_encode(
    array(
        'RESULTADO' => $clase->verificarClase()
    )
);