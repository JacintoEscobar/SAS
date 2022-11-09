<?php

// Verificamos que la petición POST y los datos del formulario sean válidos.
if (!isset($_POST) || (!isset($_POST['t']) && !isset($_POST['e']) && !isset($_POST['idE']))) {
    header("Location: http://localhost/sas/vistas/Login.php");
    die();
}

// Obtenemos la información del fomrulario
$t = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8');
$e = htmlspecialchars($_POST['e'], ENT_QUOTES, 'UTF-8');
$idE = htmlspecialchars($_POST['idE'], ENT_QUOTES, 'UTF-8');

// Registramos el nuevo material educativo en la bd.
session_start();

include_once '../modelos/MaterialEducativo.php';

$materialEducativo = new MaterialEducativo($t, $e, $_SESSION['idT'], $idE, 'enlace');
try {
    if ($materialEducativo->insertar()) {
        echo json_encode('Material educativo subido de exitosamente.');
        die();
    }
} catch (\Throwable $th) {
    echo json_encode(['ERROR_FATAL' => $th->getMessage()]);
    die();
}

echo json_encode(['ERROR' => 'ERROR_REGISTRO']);
die();
