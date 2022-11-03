<?php

/**
 * Consulta los alumnos que han respondido un cuestionario
 * para mostrar la opción de ver sus resultados al profesor.
 */
function getAlumnosRespondieron(string $idC)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = 'SELECT usuario.idUsuario as idU, usuario.nombre as alumno, usuario.paterno as paterno FROM usuario INNER JOIN cuestionarioresuelto ON cuestionarioresuelto.idUsuario = usuario.idUsuario WHERE cuestionarioresuelto.idCuestionario = ?';
        $consulta = $conexion->prepare($sql);
        $consulta->bind_param('i', $idC);
        $consulta->execute();
        $alumnos = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        $conexion->close();
        return $alumnos;
    } catch (\Throwable $th) {
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops</strong> ' . $th->getMessage() . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}

$alumnos = getAlumnosRespondieron($idCuestionario);
