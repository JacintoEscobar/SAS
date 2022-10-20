<?php

include '../modelos/Clase.php';

session_start();

$clase = new Clase(htmlspecialchars($_POST['c'], ENT_QUOTES, 'UTF-8'));

echo json_encode(
    array(
        'RESULTADO' => $clase->verificarClase()
    )
);