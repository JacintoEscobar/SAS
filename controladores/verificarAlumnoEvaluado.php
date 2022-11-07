<?php

/**
 * Consulta el registro de evaluación de un alumno de un cuestionario.
 * @param string $idA
 * @param string $idC
 * @return bool true en caso de que el alumno ya se encuentre evaluado para el cuestionario o false en caso contrario.
 */
function verificarAlumnoEvaludo(string $idA, string $idC)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT * FROM evaluacion WHERE idUsuario = ? AND idCuestionario = ?');
        $consulta->bind_param('ii', $idA, $idC);
        $consulta->execute();
        $resultado = $consulta->get_result()->num_rows;
        $conexion->close();
        return $resultado == 0;
    } catch (\Throwable $th) {
        return false;
    }
}
