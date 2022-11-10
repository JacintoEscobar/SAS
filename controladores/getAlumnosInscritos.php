<?php

/**
 * Consulta todos los alumnos que cumplen lo siguiente:
 * 1. Está inscrito en la clase a la que pertenece el material educativo y su estado es activo.
 * 2. Su etiqueta es igual a la del material educativo.
 */
function getAlumnosInscritos(string $idE, string $idME, string $idC)
{
    try {
        $con = new mysqli('localhost', 'root', '', 'sas');
        $sql = $con->prepare(
            "SELECT DISTINCT usuario.idUsuario AS idU
             FROM usuario
             INNER JOIN registroetiqueta ON usuario.idUsuario = registroetiqueta.idUsuario
             INNER JOIN materialeducativo ON registroetiqueta.idEtiqueta = materialeducativo.idEtiqueta
             INNER JOIN inscripcion ON usuario.idUsuario = inscripcion.idUsuario
             INNER JOIN clase ON inscripcion.idClase = clase.idClase
             WHERE registroEtiqueta.idEtiqueta = ? AND materialEducativo.idMaterialEducativo = ? AND clase.idClase = ? AND inscripcion.estado IN('activo')
             ORDER BY usuario.idUsuario"
        );
        $sql->bind_param('iii', $idE, $idME, $idC);
        $sql->execute();

        // Guardamos cada registro como un objeto para su acceso más sencillo.
        $registros = $sql->get_result();
        $alumnos = [];
        while ($alumno = $registros->fetch_object()) {
            array_push($alumnos, $alumno);
        }

        $con->close();

        return $alumnos;
    } catch (\Throwable $th) {
        throw $th;
    }
}
