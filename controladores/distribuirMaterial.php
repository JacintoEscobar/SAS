<?php

/**
 * Distribuye el material educativo a todos los alumnos que cumplan lo siguiente:
 * 1. Estar inscritos en la clase a la que pertenece el material educativo.
 * 2. Tener asignada la misma etiqueta que el material educativo
 */
function distribuirMaterial(string $idME, string $idU)
{
    try {
        $con = new mysqli('localhost', 'root', '', 'sas');
        $sql = $con->prepare("INSERT INTO material_alumno(idMaterialEducativo, idUsuario) VALUES(?, ?)");
        $sql->bind_param('ii', $idME, $idU);
        $sql->execute();
        $resultado = $sql->affected_rows > 0;
        $con->close();
        return $resultado;
    } catch (\Throwable $th) {
        throw $th;
    }
}
