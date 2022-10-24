<?php

/**
 * Consulta el registro de cuestionario resuelto segun el id del alumno y el id del cuestionario.
 */
function verificarCuestionarioContestado(string $idCuestionario, string $idAlumno)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = $conexion->prepare('SELECT * FROM cuestionarioresuelto WHERE idCuestionario = ? AND idUsuario = ?');
        $sql->bind_param('ii', $idCuestionario, $idAlumno);
        $sql->execute();
        return $sql->get_result()->num_rows > 0;
    } catch (Exception $ex) {
        return false;
    }
}

$haRespondido = verificarCuestionarioContestado($_SESSION['idCuestionario'], $_SESSION['i']);