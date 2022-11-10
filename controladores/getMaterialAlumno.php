<?php

/**
 * Consulta el material educativo de una clase de un alumno.
 * @param string $idAlumno
 * @param string $idClase
 * @return array
 */
function getMaterial(string $idAlumno, string $idClase)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare(
            'SELECT DISTINCT
                materialeducativo.idMaterialEducativo AS idME,
                materialeducativo.titulo AS Material,
                materialeducativo.direccion AS Direccion,
                materialeducativo.tipo AS Tipo
             FROM materialeducativo
             INNER JOIN material_alumno ON materialeducativo.idMaterialEducativo = material_alumno.idMaterialEducativo
             INNER JOIN topico ON materialeducativo.idTopico = topico.idTopico
             INNER JOIN unidadaprendizaje ON topico.idUnidadAprendizaje = unidadaprendizaje.idUnidadAprendizaje
             INNER JOIN clase ON unidadaprendizaje.idClase = clase.idClase
             INNER JOIN inscripcion ON inscripcion.idClase = clase.idClase
             INNER JOIN usuario ON inscripcion.idUsuario = usuario.idUsuario
             WHERE inscripcion.idClase = ? AND material_alumno.idUsuario = ?;'
        );
        $consulta->bind_param('ii', $idClase, $idAlumno);

        // Verificamos que la consulta se haya realizado de manera exitosa.
        if (!$consulta->execute() || !$registros = $consulta->get_result()) {
            return ['ERROR' => $conexion->error];
        }

        $materiales = [];
        while ($registro = $registros->fetch_object()) {
            array_push($materiales, $registro);
        }

        return $materiales;
    } catch (\Throwable $th) {
        return ['ERROR' => "Archivo:{$th->getFile()}\nLínea:{$th->getLine()}\nMensaje:{$th->getMessage()}"];
    }
}
