<?php

include '../modelos/Administrador.php';

$matricula = htmlentities($_POST['ma']);
$nombre = htmlentities($_POST['n']);
$paterno = htmlentities($_POST['p']);
$materno = htmlentities($_POST['m']);
$correo = htmlentities($_POST['co']);
$usuario = htmlentities($_POST['u']);
$contraseña = htmlentities($_POST['con']);
$tipoUsuario = htmlentities($_POST['t']);

$administrador = new Administrador(null);

if ($tipoUsuario == 'profesor') {
    $respuesta = $administrador->registrarProfesor($matricula, $nombre, $paterno, $materno, $correo, $usuario, $contraseña, $tipoUsuario);
} else {
    $respuesta = $administrador->registrarAlumno($matricula, $nombre, $paterno, $materno, $correo, $usuario, $contraseña, $tipoUsuario);
}

if (!$respuesta) {
    echo json_encode('ERROR_DE_REGISTRO');
}

echo json_encode('REGISTRO_EXITOSO');
