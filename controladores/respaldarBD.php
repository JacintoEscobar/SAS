<?php
include '../modelos/BD.php';

$baseDatos = new BD();

if (!$baseDatos->conectar()) {
    echo json_encode(array('ERROR_DE_CONEXION' => 'Ocurrió un error al intentar conectarse con la base de datos.'));
}

echo json_encode(
    array(
        'EXITO' => $baseDatos->respaldar()
    )
);
