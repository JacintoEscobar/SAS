<?php

/**
 * Realiza el registro de la evaluación del alumno en la bd.
 * @param mixed $obj
 * @return bool true si el registro fue exitoso o false en caso contrario o de error.
 */
function registrarEvaluacion($obj)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('INSERT INTO evaluacion(puntaje, idCuestionario, idUsuario, idEtiqueta) VALUES(?, ?, ?, ?)');
        $consulta->bind_param('iiii', $obj->puntaje, $obj->idC, $obj->idA, $obj->idE);
        $consulta->execute();
        $resultado = $consulta->affected_rows;
        $conexion->close();
        return $resultado > 0;
    } catch (\Throwable $th) {
        throw $th;
    }
}

$data = json_decode($_POST['obj']);

try {
    if (registrarEvaluacion($data)) {
        echo json_encode('Alumno evaludo correctamente.');
        die();
    }

    echo json_encode('Ocurrió un error al evaluar al alumno.');
    die();
} catch (\Throwable $th) {
    echo json_encode($th->getMessage());
}
