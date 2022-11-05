<?php

/**
 * Realiza la consulta para registrar que el alumno respondió el cuestionario
 * @param string $idC
 * @param string $idU
 * @return bool true si el registro fue exitoso o false en caso contrario o de error.
 */
function registrarCuestionarioResuelto(string $idC, string $idU)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('INSERT INTO cuestionarioresuelto(idCuestionario, idUsuario) VALUES(?, ?)');
        $consulta->bind_param('ii', $idC, $idU);
        $resultado = $consulta->execute();
        $conexion->close();
        return $resultado;
    } catch (\Throwable $th) {
        return false;
    }
}

/**
 * Realiza la consulta de inserción de la respuesta del alumno.
 * @param object $respuesta
 * @param string $idU id del alumno que responde el cuestionario.
 * @return bool true si la inserción fue correcta o false en caso contrario.
 */
function registrarRespuestaAbierta(object $respuesta, string $idU)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('INSERT INTO respuestaalumno(contenido, idRespuestaMultiple, idUsuario) VALUES(?, ?, ?)');
        $consulta->bind_param('sii', $respuesta->contenido, $respuesta->idRespuestaMultiple, $idU);
        $resultado = $consulta->execute();
        $conexion->close();
        return $resultado;
    } catch (\Throwable $th) {
        return false;
    }
}

// Obtenemos el id del alumno que respondió el cuestionario
// y el id del cuestionario para registrar su respuesta por parte del alumno.
session_start();
$idU = $_SESSION['i'];
$idC = $_SESSION['idCuestionario'];

// Obtenemos las respuestas del alumno y las parseamos para su inserción en la bd.
$respuestas = json_decode($_POST['respuestas']);

$num_respuestas = sizeof($respuestas);

// Insertamos las respuestas en la bd.
for ($i = 0; $i < $num_respuestas; $i++) {
    if (!registrarRespuestaAbierta($respuestas[$i], $idU)) {
        echo json_encode('Ocurrió un error al registrar tus respuestas.');
        die();
    }
}

if (!registrarCuestionarioResuelto($idC, $idU)) {
    echo json_encode('Ocurrió un error al registrar tus respuesta.');
    die();
}

echo json_encode('Cuestionario contestado de manera correcta.');
die();
