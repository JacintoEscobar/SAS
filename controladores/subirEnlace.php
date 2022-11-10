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

        // Preparamos la distribución del material educativo.
        // 1. Obtenemos el id del material educativo.
        $idMaEd = MaterialEducativo::getMaterial($t, $e, $_SESSION['idT'], $idE, 'enlace');

        // 1. Obtenemos a los alumnos inscritos en la clase y cuya etiqueta sea igual a la del material educativo.
        include_once './getAlumnosInscritos.php';
        $alumnos = getAlumnosInscritos($idE, $idMaEd, $_SESSION['idC']);

        // 2. Registramos en la bd la distribución material-alumno.
        include_once './distribuirMaterial.php';
        foreach ($alumnos as $alumno) {
            if (!distribuirMaterial($idMaEd, $alumno->idU)) {
                echo json_encode(['ERROR' => 'ERROR_REGISTRO']);
                die();
            }
        }

        echo json_encode('Material educativo subido y distribuido exitosamente.');
        die();
    }
} catch (\Throwable $th) {
    echo json_encode(['ERROR_FATAL' => "Arcvhio:{$th->getFile()}\nLínea:{$th->getLine()}\nMensaje:{$th->getMessage()}"]);
    die();
}

echo json_encode(['ERROR' => 'ERROR_REGISTRO']);
die();
