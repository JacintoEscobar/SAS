<?php

/**
 * Realiza la consulta del tipo de cuestionario
 * para manejar las respuestas del alumno como cerradas o abiertas.
 * @param string $idC
 */
function getTipoCuestionario(string $idC)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT tipo FROM cuestionario WHERE idCuestionario = ?');
        $consulta->bind_param('i', $idC);
        $consulta->execute();
        $tipo = $consulta->get_result()->fetch_column(0);
        $conexion->close();
        return $tipo;
    } catch (\Throwable $th) {
        return null;
    }
}

$tipoCuestionario = getTipoCuestionario($idCuestionario);
