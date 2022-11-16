<?php

/*Se consulta a los estudiantes inscritos a una clase*/
function get_alumnos_inscritos($idClase)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT usuario.idUsuario, matricula, usuario.nombre, paterno, materno FROM usuario INNER JOIN inscripcion ON usuario.idUsuario=inscripcion.idUsuario INNER JOIN clase ON clase.idClase=inscripcion.idClase WHERE clase.idClase= ?');
        $consulta->bind_param('i', $idClase);
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $ex) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops</strong> ' . $ex->getMessage() . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$alumnos = get_alumnos_inscritos(htmlspecialchars($_GET['i'], ENT_QUOTES, 'UTF-8'));

