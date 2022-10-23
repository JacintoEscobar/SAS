<?php

/**
 * Se consulta el cuestionario por medio del id.
 * @return array Datos del cuestionario.
 */
function getCuestionario(string $idCuestionario)
{
    try {
        $conexion = new mysqli('localhost', 'root', '', 'sas');
        $sql = $conexion->prepare('SELECT * FROM cuestionario WHERE idCuestionario = ?');
        $sql->bind_param('i', $idCuestionario);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    } catch (Exception $ex) {
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops</strong> ' . $ex->getMessage() . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}

$cuestionario = getCuestionario(htmlspecialchars($idCuestionario, ENT_QUOTES, 'UTF-8'));
