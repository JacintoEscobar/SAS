<?php

/**
 * Consulta las etiquetas registradas en la bd para
 * que el profesor pueda asignar alguna a sus alumnos.
 * @param string $idU
 * @return mixed arreglo de los registros de las etiquetas.
 */
function getEtiquetas(string $idU)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT * FROM etiqueta INNER JOIN creacionetiqueta ON creacionetiqueta.idEtiqueta = etiqueta.idEtiqueta WHERE creacionetiqueta.idUsuario = ?');
        $consulta->bind_param('i', $idU);
        $consulta->execute();
        $etiquetas = $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
        $conexion->close();
        return $etiquetas;
    } catch (\Throwable $th) {
        return null;
    }
}

/**
 * Consulta el id máximo de la tabla de etiquetas para
 * asignar los id a los elementos de las etiquetas creadas.
 */
function getMaxId()
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT MAX(idEtiqueta) AS idMax FROM etiqueta');
        $consulta->execute();
        $idMax = $consulta->get_result()->fetch_object()->idMax;
        $conexion->close();
        return $idMax;
    } catch (\Throwable $th) {
        return null;
    }
}
