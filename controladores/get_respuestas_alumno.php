<?php

/**
 * Consulta una respuesta alumno mediante el id de la respuesta multiple.
 * Si el registro existe, entonces el alumno seleccionÃ³ como respuesta la respuesta actual,
 * caso contrario seleccionÃ³ otra respuesta definida por el profesor.
 * @param string $idRespuestaMultiple id de la respuesta seleccionada por el profesor.
 * @return boolean Verdadero si el registro existe o falso en caso contrario o en caso de algun error.
 */
function verificarRespuesta(string $idRespuestaMultiple, string $idUsuario)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT * FROM respuestaalumno WHERE idRespuestaMultiple = ? AND idUsuario = ?');
        $consulta->bind_param('ii', $idRespuestaMultiple, $idUsuario);
        $consulta->execute();
        $registro = $consulta->get_result()->fetch_assoc();
        $conexion->close();
        return $registro != null;
    } catch (\Throwable $th) {
        return false;
    }
}

/**
 * Consulta la respuesta de un alumno y devuelve el texto de esta
 */
function getRespuestaAlumno(string $idRespuestaMultiple, string $idUsuario)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT contenido FROM respuestaalumno WHERE idRespuestaMultiple = ? AND idUsuario = ?');
        $consulta->bind_param('ii', $idRespuestaMultiple, $idUsuario);
        $consulta->execute();
        $contenido = $consulta->get_result()->fetch_column(0);
        $conexion->close();
        return $contenido;
    } catch (\Throwable $th) {
        return null;
    }
}
