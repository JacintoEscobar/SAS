<?php
/*Se consulta a los estudiantes inscritos a una clase*/
function consultaCuestionarios($idC)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $consulta = $conexion->prepare('SELECT DISTINCT cuestionario.idCuestionario AS idCuestionario, titulo FROM cuestionario INNER JOIN asignacion on asignacion.idCuestionario=cuestionario.idCuestionario WHERE asignacion.idClase=?');
        $consulta->bind_param('i', $idC);
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

$cuestionarios = consultaCuestionarios(htmlspecialchars($_GET['idC'], ENT_QUOTES, 'UTF-8'));
?>