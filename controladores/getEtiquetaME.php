<?php

/**
 * Consulta el nombre de una etiqueta asignada a un material educativo.
 */
function getEtiquetaME(string $idME)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT nombre FROM etiqueta INNER JOIN materialeducativo ON materialeducativo.idEtiqueta = etiqueta.idEtiqueta WHERE etiqueta.idEtiqueta = ?');
        $consulta->bind_param('i', $idME);
        $consulta->execute();
        $etiqueta = $consulta->get_result()->fetch_column(0);
        $conexion->close();
        return $etiqueta;
    } catch (\Throwable $th) {
    }
}
