<?php

/**
 * Consulta los materiales educativos de un tópico.
 * @param string idT
 * @return array|null arreglo con los objetos de los materiales educativos. Null si no hay ningun creado.
 */
function getMaterialEducativo(string $idT)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT * FROM materialeducativo WHERE idTopico = ?');
        $consulta->bind_param('i', $idT);
        $consulta->execute();
        $registros = $consulta->get_result();
        if ($registros->num_rows > 0) {
            $materialesEducativos = [];
            while ($materialEducativo = $registros->fetch_object()) {
                array_push($materialesEducativos, $materialEducativo);
            }
            return $materialesEducativos;
        }
        echo
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Todo bien!</strong> Da clic en nuevo para comenzar a adjuntar material educativo.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        return null;
    } catch (\Throwable $th) {
        echo
        '<div class="alert alert-danger" role="alert">
            ' . $th->getLine() . '!
        </div>';
    }
}
