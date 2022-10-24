<?php

/**
 * Registra la resolución del cuestionario por el alumno.
 * @param string $idC id del cuestionario resuelto.
 * @param string $idA id del alumno que contestó el cuestionario.
 */
function registrarCuestionarioResuelto(string $idC, string $idA)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = $conexion->prepare('INSERT INTO cuestionarioresuelto(idCuestionario, idUsuario) VALUES(?, ?)');
        $sql->bind_param('ii', $idC, $idA);
        $sql->execute();
        unset($_SESSION['idCuestionario']);
        echo json_encode('Has contestado tu cuestionario de manera satisfactoria.');
    } catch (Exception $ex) {
        echo json_encode($ex->getMessage());
    }
}

/**
 * Registra las respuestas del alumno en la base de datos.
 * @param Object $respuesta
 */
function registrarRespuesta($respuesta)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = $conexion->prepare('INSERT INTO respuestaalumno(contenido, idRespuestaMultiple, idUsuario) VALUES(?, ?, ?)');
        $sql->bind_param('sii', $respuesta->contenido, $respuesta->idRespuestaMultiple, $respuesta->idUsuario);
        $sql->execute();
    } catch (Exception $ex) {
        echo json_encode($ex->getMessage());
    }
}

// Obtenemos las respuestas del alumno.
$respuestas = json_decode($_POST['respuestas']);

session_start();

// Obtenemos el id del alumno.
$idAlumno = $_SESSION['i'];

// Obtenemos el id del cuestionario.
$idCuestionario = $_SESSION['idCuestionario'];

// Insertamos las respuestas del alumno en la base de datos.
$num_respuestas = sizeof($respuestas);
for ($i = 0; $i < $num_respuestas; $i++) {
    $respuestas[$i]->idUsuario = $idAlumno;
    registrarRespuesta($respuestas[$i]);
}

// Registramos que el alumno ya ha respondido el cuestionario.
registrarCuestionarioResuelto($idCuestionario, $idAlumno);