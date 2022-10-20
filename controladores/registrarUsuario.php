<?php

include '../modelos/Administrador.php';

$matricula = htmlspecialchars($_POST['ma'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['n'], ENT_QUOTES, 'UTF-8');
$paterno = htmlspecialchars($_POST['p'], ENT_QUOTES, 'UTF-8');
$materno = htmlspecialchars($_POST['m'], ENT_QUOTES, 'UTF-8');
$correo = htmlspecialchars($_POST['co'], ENT_QUOTES, 'UTF-8');
$usuario = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
$contraseña = htmlspecialchars($_POST['con'], ENT_QUOTES, 'UTF-8');
$tipoUsuario = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8');

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
