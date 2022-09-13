<?php

include '../modelos/Profesor.php';

$nombre = htmlentities($_POST['n']);
$paterno = htmlentities($_POST['p']);
$materno = htmlentities($_POST['m']);
$correo = htmlentities($_POST['co']);
$usuario = htmlentities($_POST['u']);
$contraseña = htmlentities($_POST['con']);

$profesor = new Profesor(null);

$respuesta = $profesor->registrarAlumno($nombre, $paterno, $materno, $correo, $usuario, $contraseña);

if (!$respuesta) {
    echo json_encode('ERROR_DE_REGISTRO_ALUMNO');
}

echo json_encode('REGISTRO_EXITOSO_ALUMNO');
