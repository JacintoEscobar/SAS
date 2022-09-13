<?php

include '../modelos/Administrador.php';

$nombre = htmlentities($_POST['n']);
$paterno = htmlentities($_POST['p']);
$materno = htmlentities($_POST['m']);
$correo = htmlentities($_POST['co']);
$usuario = htmlentities($_POST['u']);
$contraseña = htmlentities($_POST['con']);

$administrador = new Administrador(null);

$respuesta = $administrador->registrarProfesor($nombre, $paterno, $materno, $correo, $usuario, $contraseña);

if (!$respuesta) {
    echo json_encode('ERROR_DE_REGISTRO_PROFESOR');
}

echo json_encode('REGISTRO_EXITOSO_PROFESOR');
