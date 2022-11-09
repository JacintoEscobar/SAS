<?php

/**
 * Consulta la información de un tópico basándose en su id.
 * @param string $idT
 * @return mixed arreglo asociativo con la información del registro obtenido.
 */
function getTopico(string $idT)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');

        $consulta = $conexion->prepare('SELECT * FROM topico WHERE idTopico = ?');
        $consulta->bind_param('i', $idT);
        $consulta->execute();
        $registro = $consulta->get_result()->fetch_assoc();

        $conexion->close();

        return $registro;
    } catch (\Throwable $th) {
    }
}

$topico = getTopico($idT);
